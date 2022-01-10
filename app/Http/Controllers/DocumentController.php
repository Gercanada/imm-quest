<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            $userId = 'userId';
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
        $file = substr($request->file, 1);
        if (File::exists($file)) {
            // Elimina imagen del servidor
            File::delete($file);
            $respuesta = [
                'mensaje' => 'Imagen Eliminada',
                'imagen' => $file
            ];
            return $respuesta;
        } else {
            return "File $file not found";
        }
        try {
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
                return response()->json([['count' => count($urlFiles)], ['files' => $urlFiles]],200);
            } else {
                return;
            }
        } catch (\Exception $e) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->write($e);
        }
    }
}
