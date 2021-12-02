<?php

namespace App\Http\Controllers;

use App\Models\CLItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\User;

class CLItemController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function show(/* CLItem $cLItem, $id */Request $request)
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

                )
                ->take(1);

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
            //$user_id = $user->id;
            $vtiger = new Vtiger();
            $userQuery = DB::table('Contacts')->select('id')->where("id", $user->vtiger_contact_id)->take(1);
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

                $destination = "documents/contact_$contact_id/clitems/$clitem->id";
                //loop throu the array
                foreach ($files as $file) {
                    //return $file;
                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);

                    $file->storeAs($destination, $filename);
                    $fileUrl = "$destination/$filename";
                    array_push($fileList, $fileUrl);
                }

                $document = Document::create([
                    'contact_id' => $contact_id,
                    'url_files' => json_encode($fileList)
                ]);

                return response()->json(200);
            }
        } catch (\Exception $e) {
            return  response()->json(['message' => 'error uploading file', $e], 503);
        }
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
