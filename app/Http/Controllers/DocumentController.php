<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Contact;
use Exception;

class DocumentController extends Controller
{
    public function index()
    {
        return view('users.documents');
    }

    public function getDocuments()
    { //Get contact data of this user
        try {
            $user      = Auth::user();
            $contact   = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
            $documents = DB::table('vt_Documents')->where('cf_1488', $contact->id)->get();
            return response()->json($documents, 200);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['DocumentController' => 'getDocuments']);
        }
    }


    /**
     * This method is called as web servoce to delete files from temporary storage when was uploaded to google drive.
     */
    public function destroy(Request $request)
    {
        try {
            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln('A file be deleted');
            }
            $return = response()->json(200);
            $file = substr($request->file, 1);
            $exploded = explode('/', $file);

            if (env('APP_ENV') === 'local') {
                $spliced = array_splice($exploded, 4);
            } else {
                $spliced = array_splice($exploded, 5);
            }
            $file = implode('/', $spliced);

            if (env('APP_ENV') === 'local') {
                $file = 'public/' . $file;
            }

            $file =  str_replace('_', ' ', $file);

            if (Storage::exists($file)) {
                Storage::delete($file);
                $return = response()->json("File removed from temporary storage", 200);
            } else {
                $return = response()->json("File not found", 404);
            }

            //Empty folders be deleted
            $mainDir = Storage::allDirectories("/public/documents/contact/");
            $dirs = [];

            foreach ($mainDir as $dir) {
                $expDir = explode('/', $dir);
                $newDir = implode('/', $expDir);
                array_push($dirs, $dir);
                $files = Storage::disk('public')->allFiles($newDir);
                if (count($files) === 0) {
                    Storage::deleteDirectory($dir);
                }
            }
            return $return;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['DocumentController' => 'destroy']);
        }
    }

    /**
     * this method returns a list of files of a selected contact.
     */
    public function checkDocuments(Request $request)
    {
        try {
            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln("CHecking files");
            }
            $user = User::where('vtiger_contact_id', $request->cid)->firstOrFail();
             $natDir = "/documents/contact/$user->vtiger_contact_id/cases/$request->case/checklists/$request->checklist/clitems/$request->clitem";
            $directory = str_replace(" ", "_", $natDir);
            $files = Storage::disk('public')->allFiles($directory);
            $urlFiles = [];
            $pathFiles = [];
            foreach ($files as $file) {
                $eachFile = str_replace(' ', '_', $file);
                $fullurl = '';
                if (env('APP_ENV') === 'local') {
                    $storagePath = Storage::url($eachFile);
                    $fullurl = env('APP_URL') . Storage::url($eachFile);
                    if (env('APP_ENV') === 'local') {
                        $this->consoleWrite()->writeln($fullurl);
                    }
                    array_push($pathFiles, $storagePath);
                    array_push($urlFiles, $fullurl);
                } else {
                    $storagePath = Storage::url("app/public/$eachFile");
                    $fullurl = env('APP_URL') . Storage::url("app/public/$eachFile");
                    /* $headers = get_headers($fullurl); 
                    if ($headers && strpos($headers[0], '200')) {
                    }*/
                    // array_push($urlFiles, ($fullurl)); // in prod
                    array_push($pathFiles, $storagePath);
                    array_push($urlFiles, $fullurl);
                }
                if (env('APP_ENV') === 'local') {
                    $this->consoleWrite()->writeln('Simple url getted');
                    $this->consoleWrite()->writeln($fullurl);
                }
            }
            return [$pathFiles, $urlFiles];
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['DocumentController' => 'checkDocuments']);
        }
    }


    /**
     * This methods only returns request env['response'][$loop].
     * Is required because the workflow block crashes at try to upload file using env['response'][$loop]
     */
    public function singleUrl(Request $request)
    {
        try {
            $preUrl =  $request->server_name . $request->file;
            $ex = explode('/', $preUrl);
            $arr = [];
            foreach ($ex as $word) {
                $newword = str_replace(" ", "_", $word);
                array_push($arr, $newword);
            }
            $url = implode("/", $arr);
            $headers = get_headers($url);

            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln('Simple url getting');
            }

            if ($headers && strpos($headers[0], '200')) {
                return $url;
            }
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['DocumentController' => 'singleUrl']);
        }
    }
}
