<?php

namespace App\Http\Controllers;

use App\Models\CLItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\User;
Use Carbon\Carbon;

class CLItemController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $vtiger = new Vtiger();
        $clitemQuery =  DB::table('CLItems')->select('*')
            ->where('id', $request->id)
            ->take(1);

        $item = [];
        $case = [];
        $checklist = [];
        if (count(array_keys($vtiger->search($clitemQuery)->result)) !== 0) {
            $item = $vtiger->search($clitemQuery)->result[0];

            $casesQuery =  DB::table('HelpDesk')
                ->select('*')
                ->where(
                    'id',
                    $item->cf_1217
                )
                ->take(1);

            $case = $vtiger->search($casesQuery)->result[0];

            $checklistQuery =  DB::table('Checklist')
                ->select('*')
                ->where(
                    'id',
                    $item->cf_1216
                )->take(1);

            $checklist = $vtiger->search($checklistQuery)->result[0];
        }
       return [$item, $case, $checklist];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function dvupload($id)
    {
        $vtiger = new Vtiger();
        $clitemQuery =  DB::table('CLItems')->select('*')
            ->where('id', $id)
            ->take(1);

        $cl_item = null;
        if (count(array_keys($vtiger->search($clitemQuery)->result)) !== 0) {
            $cl_item = $vtiger->search($clitemQuery)->result[0];
        }
        return view('checklists.items.item-dv-upload', compact('cl_item'));
    }

    /**
     * This method allows upload files related with clitem
     */
    public function uploadFile(Request $request)
    {
        try {
            $user = Auth::user();
            $vtiger = new Vtiger();
            $userQuery = DB::table('Contacts')->select('id', 'contact_no')->where("contact_no", $user->vtiger_contact_id)->take(1);
            $contact = $vtiger->search($userQuery);

            $clitemsQuery =  DB::table('CLItems')->select('*')
                ->where('id', $request->id)
                ->take(1);

            $contact_id = $contact->result[0]->id;
            $clitem = $vtiger->search($clitemsQuery)->result[0];

            if ($request->file('file')) {
                /* Multiple file upload */
                $files = $request->file('file');
                if (!is_array($files)) {
                    $files = [$files];
                }

                $fileList = array();
                $contact_no = $contact->result[0]->contact_no;

                $destination = "documents/contact/$contact_no/clitem/$clitem->id";

                foreach ($files as $file) {

                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);
                    $filename = str_replace('-', '_', $filename);

                    $file->storeAs("/public/$destination", $filename);
                    $fileUrl = "$destination/$filename";
                    array_push($fileList, $fileUrl);

                    Document::create([
                        'user_id'=>$user->id,
                        'contact_id' => $contact_id,
                        'url_file' => $fileUrl
                    ]);
                }
                return response()->json(["List" => $fileList, 200]);
            }
        } catch (\Exception $e) {
            return  response()->json(['message' => 'error uploading file', $e], 503);
        }
    }



    public function downloadFile($contact)
    {
        $directory = "/documents/contact/$contact";

        $files = Storage::disk('public')->allFiles($directory);
        //return $files;
        $urlFiles = [];

        foreach ($files as $file) {
            array_push($urlFiles, (Storage::url($file)));
        }
        return $urlFiles;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CLItem $cLItem)
    {
        //
    }
}
