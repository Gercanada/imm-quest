<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $documents = Document::where('user_id', $user_id)->get();

        return view('users.documents', compact('documents'));
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
                    $fileArray = array();

                    $file = $files[$i];
                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);

                    $file->storeAs('documents', $filename);

                    $fileArray[] = $filename;

                    array_push($fileList, $fileArray);
                }

                return $fileList;

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
        } catch (Throwable $e) {
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
