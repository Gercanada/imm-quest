<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Checklist;
use App\Models\CLItem;
use App\Models\CPCase;
use App\Models\Contact;

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
        $item = CLItem::where('id', $request->id)->firstOrFail();
        $case =  CPCase::where('id', $item->cf_1217)->firstOrFail();
        $checklist =  Checklist::where('id', $item->cf_1216)->firstOrFail();
        return [$item, $case, $checklist];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function dvupload($check_list, $id)
    {
        $cl_item =   CLItem::where('id', $id)->get();
        return view('checklists.items.item-dv-upload', compact('cl_item'));
    }

    /**
     * This method allows upload files related with clitem
     */
    public function uploadFile(Request $request)
    {
        try {
            $user = Auth::user();
            $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();

            $clitem = CLItem::where('id', $request->id)->firstOrFail();
            if ($request->file('file')) {
                /* Multiple file upload */
                $files = $request->file('file');
                if (!is_array($files)) {
                    $files = [$files];
                }

                $fileList = array();
                $contact_no = $contact->contact_no;

                $destination = "documents/contact/$contact_no/clitem/$clitem->clitemsno";
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);
                    $filename = str_replace('-', '_', $filename);

                    $file->storeAs("/public/$destination", $filename);
                    $fileUrl = "$destination/$filename";
                    array_push($fileList, $fileUrl);
                }
                return response()->json(["List" => $fileList, 200]);
            }
        } catch (\Exception $e) {
            return  response()->json(['message' => $e], 503);
        }
    }

    public function downloadFile($contact)
    {
        $directory = "/documents/contact/$contact";
        $files = Storage::disk('public')->allFiles($directory);
        $urlFiles = [];

        foreach ($files as $file) {
            if (env('APP_ENV') === 'local') {
                array_push($urlFiles, (Storage::url($file)));
            } else {
                array_push($urlFiles, (Storage::url("app/public/$file"))); // in prod
            }
        }
        return $urlFiles;
    }
}
