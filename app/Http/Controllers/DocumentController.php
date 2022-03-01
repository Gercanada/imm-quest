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
    {//Get contact data of this user
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
            $return = '';
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

            $file =  str_replace('%20', ' ', $file);

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
                //$dirPath = array_shift($expDir);
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
            $user = User::where('vtiger_contact_id', $request->cid)->firstOrFail();
            $directory = "/documents/contact/$user->vtiger_contact_id/cases/$request->case/checklists/$request->checklist/clitems/$request->clitem";
            $files = Storage::disk('public')->allFiles($directory);
            $urlFiles = [];
            foreach ($files as $file) {
                // /$file =  str_replace(' ', '%20', $file);
                if (env('APP_ENV') === 'local') {
                    array_push($urlFiles, (Storage::url($file)));
                } else {
                    array_push($urlFiles, (Storage::url("app/public/$file"))); // in prod
                }
            }
            return $urlFiles;
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
            $url = str_replace(" ", "%20", $preUrl);
            return $url;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['DocumentController' => 'singleUrl']);
        }
    }
}
