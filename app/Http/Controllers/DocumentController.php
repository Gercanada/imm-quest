<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use App\Models\User;
use App\Models\Contact;
use Exception;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        return view('users.documents');
    }

    public function getDocuments()
    {
        $user = Auth::user();
        //Get contact data of this user
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        //Documents
        $documents = DB::table('vt_Documents')->where('cf_1488', $contact->id)->get();
        return response()->json($documents, 200);
    }


    /**
     * This method is called as web servoce to delete files from temporary storage when was uploaded to google drive.
     */
    public function destroy(Request $request)
    {
        try {
            $return = '';
            $file = substr($request->file, 1);
            $exploded = explode('/', $file);
            $spliced = array_splice($exploded, 2);
            $file = implode('/', $spliced);
            if (Storage::exists($file)) {
                Storage::delete($file);
                $return = response()->json("File removed from temporary storage");
            } else {
                $return = response()->json("File not found");
            }

            //Empty folders be deleted
            $mainDir = Storage::allDirectories("/public/documents/contact/");
            $dirs = [];

            foreach ($mainDir as $dir) {
                $expDir = explode('/', $dir);
                $dirPath = array_shift($expDir);
                $newDir = implode('/', $expDir);

                array_push($dirs, $dir);

                $files = Storage::disk('public')->allFiles($newDir);

                if (count($files) === 0) {
                    Storage::deleteDirectory($dir);
                }
            }
            return $return;
        } catch (Exception $e) {
            return $e->getMessage();
            return response()->json([$e, 500]);
        }
    }

    /**
     * this method returns a list of files of a selected contact.
     */
    public function checkDocuments(Request $request)
    {
        try {
           /*  $out = new \Symfony\Component\Console\Output\ConsoleOutput();*/
            $user = User::where('vtiger_contact_id', $request->cid)->firstOrFail();
            $directory = "/documents/contact/$user->vtiger_contact_id/cases/$request->case/checklists/$request->checklist/clitems/$request->clitem";

            $files = Storage::disk('public')->allFiles($directory);
            $urlFiles = [];
            for ($i = 0; $i < 3; $i++) {
                while (count($urlFiles) === 0) {
                    foreach ($files as $file) {
                        //$file =  str_replace(' ', '%20', $file);
                        if (env('APP_ENV') === 'local') {
                            array_push($urlFiles, (Storage::url($file)));
                        } else {
                            array_push($urlFiles, (Storage::url("app/public/$file"))); // in prod
                        }
                    }
                }
            }
            return response()->json($urlFiles, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
           // $out->write($e);
        }
    }

    /**
     * this method be called as webservice to create the document record relar=ted with the clitem and uploaded file.
     */
    public function createCLItemDoc(Request $request)
    {
        try {
            $vtiger = new Vtiger();
            $userQuery = DB::table('CLItems')->select('*')->where("id", $request->clitemsno)->take(1);
            $clitem = $vtiger->search($userQuery)->result[0];

            $data = [
                "notes_title"       => $clitem->name ?? '',
                "assigned_user_id"  => $clitem->assigned_user_id,
                "filelocationtype"  => $request->filelocationtype,
                "cf_1487"           => $clitem->cf_1217 ?? '', //case
                "cf_1488"           => $clitem->cf_contacts_id ?? '', //cotact
                "cf_clitems_id"     => $clitem->id ?? '', // id

                "filename"          => $request->filename ?? '',
                "cf_1491"           => "Contact Document"

                //"notecontent" => $request->notecontent ?? '',
                //"cf_2271" => $request->fileUrl ?? ''

                //"folderid" => $request->folder ?? '',
                //"cf_1490" => $request->payment ?? '',
                //"cf_2129" => $request->invoice ?? '',
                //"cf_quotes_id" => $request->quote ?? '',
            ];
            $data = $vtiger->create('Documents', ($data));
            return 200;
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * This methods only returns request env['response'][$loop]. Is required because the workflow block crashes at try to upload file using env['response'][$loop]
     */
    public function singleUrl(Request $request)
    {
        $ex = explode('/', $request->file);
        $url = str_replace(' ', '%20', env('APP_URL') . $request->file);
        return response()->json($url);
    }

    /*
        // make directory with custom function
          $cf_1332/$contact_no/$contact_no-cases/
                ${
                    $file = substr( $env["simpleurl"], 1);   $exploded = explode('/',  $file );
                    $exploded = explode('/',  $file );
                    $spliced = array_splice($exploded, 2);  return $spliced[5]."/01_SuppliedDocs" ;
                }}>

                ${
                     $file = substr( $env["simpleurl"], 1);   $exploded = explode('/',  $file );
                      $exploded = explode('/',  $file );  $spliced = array_splice($exploded, 2);
                      return "checklists/".$spliced[7]."/clitems/". $spliced[9] ;
            }}>

                    -----------

                     $cf_1332/$contact_no/$contact_no-cases/
                ${
                    $file = substr( $env["simpleurl"], 1);
                    $exploded = explode('/',  $file );
                    $spliced = array_splice($exploded, 2);
                    $path1 =  $spliced[5]."/01_SuppliedDocs";
                    return  str_replace(' ', '%20', $path1);
            }}>
                    ${
                     $file = substr( $env["simpleurl"], 1);
                     $exploded = explode('/',  $file );
                      $spliced = array_splice($exploded, 2);
                      return  str_replace(' ', '%20', "checklists/".$spliced[7]."/clitems/".$spliced[9]);
                    }}>

             */
}
