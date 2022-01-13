<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Document;
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

    public function store(Request $request)
    {
        try {
            if ($request->file('file')) {
                /* Multiple file upload */
                $files = $request->file('file');
                if (!is_array($files)) {
                    $files = [$files];
                }

                $fileList = array();
                //loop throu the array
                for ($i = 0; $i < count($files); $i++) {
                    $file = $files[$i];
                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);
                    $file->storeAs('documents', $filename);
                    array_push($fileList, $filename);
                }

                //return $fileList;
                $document = new Document;
                $document->user_id = $request['uuid'];
                $document->title = $request['title'];
                $document->description = $request['description'];
                $document->issued_date = $request['issued_date'];
                $document->expiry_date = $request['expiry_date'];
                $document->url_files = $fileList;
                $document->save();

                return response()->json(['message' => 'file uploaded', 'data' => $document], 200);
            } else {
                return response()->json(['message' => 'error uploading file'], 503);
            }
        } catch (\Exception $e) {
            return  response()->json(['message' => 'error uploading file', $e], 503);
        }
    }

    public function destroy(Request $request)
    {
        try {
           $file = substr($request->file, 1);
            $exploded = explode('/', $file);
            $spliced = array_splice($exploded, 2);
            $file = implode('/', $spliced);
            if (Storage::exists($file)) {
                Storage::delete($file);
                return  response()->json("File deleted");
            } else {
                return response()->json("File not found");
            }
        } catch (Exception $e) {
            return response()->json([$e, 500]);
        }
    }

    ///Api methods
    public function checkDocuments(Request $request)
    {
        try {
            $user = User::where('vtiger_contact_id', $request->cid)->firstOrFail();
            $directory = "/documents/contact/$user->vtiger_contact_id";
            $files = Storage::disk('public')->allFiles($directory);
            $urlFiles = [];
            foreach ($files as $file) {
                if (env('APP_ENV') === 'local') {
                    array_push($urlFiles, (Storage::url($file)));
                } else {
                    array_push($urlFiles, (Storage::url("app/public/$file"))); // in prod
                }
            }
            if (count($urlFiles) > 0) {
                return response()->json($urlFiles, 200);
            }
        } catch (\Exception $e) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->write($e);
        }
    }

    public function createCLItemDoc(Request $request)
    {
        try {
            $vtiger = new Vtiger();

            $str = "ah si"."si";

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

    public function singleUrl(Request $request ){
        return response()->json("env('APP_URL')$request->file");
    }
}
