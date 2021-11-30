<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\User;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        return view('users.documents');
    }

    public function getDocuments()
    {
        $user = Auth::user();

        $vtiger = new Vtiger();
        //Get contact data of this user
        $userQuery = DB::table('Contacts')->select('id')->where("id", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        //Documents
        $documentsQuery = DB::table('Documents')->select('*')
            ->where('cf_1488', $contact->result[0]->id)
            ->orWhere('cf_1488', '12x2427')
            ;
        $documents = $vtiger->search($documentsQuery)->result;

        return $documents;
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
                    $fileArray = array();

                    $file = $files[$i];
                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);

                    $file->storeAs('documents', $filename);

                    //$fileArray[] = $filename;
                    $fileUrl = "/documents/.$userId./.$filename.";
                    $fileUrl = "/documents/.$filename.";

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

                return $document;

                return response()->json(['message' => 'file uploaded', 'data' => $document], 200);
            } else {
                return response()->json(['message' => 'error uploading file'], 503);
            }
        } catch (Exception $e) {
            return  response()->json(['message' => 'error uploading file', $e], 503);
        }
    }

    public function destroy(Request $request)
    {
        // Validación
        $uuid = $request->get('uuid');
        $user = User::where('uuid', $uuid)->first();
        $this->authorize('delete', $user);


        // Imagen a eliminar
        $imagen = $request->file('file');

        if (File::exists('storage/' . $imagen)) {
            // Elimina imagen del servidor
            File::delete('storage/' . $imagen);

            // elimina imagen de la BD
            //Imagen::where('ruta_imagen', $imagen)->delete();

            $respuesta = [
                'mensaje' => 'Imagen Eliminada',
                'imagen' => $imagen
            ];
        }
        return response()->json($respuesta);
    }
}
