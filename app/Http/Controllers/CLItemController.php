<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Checklist;
use App\Models\CLItem;
use App\Models\CPCase;
use App\Models\Contact;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\DB;
use Exception;


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


        /* $directory = "/documents/contact/$item->cf_contacts_id/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$item->clitemsno-$item->cf_1200";
        $file = Storage::disk('public')->allFiles($directory); */


        $checklist =  Checklist::where('id', $item->cf_1216)->firstOrFail();
        $contact = Contact::where('id', $item->cf_contacts_id)->firstOrFail();

        $directory = "/documents/contact/$contact->contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$item->clitemsno-$item->cf_1200";
        $dirFiles = Storage::disk('public')->allFiles($directory);
        $files = [];
        foreach ($dirFiles as $file) {
            array_push($files, $file);
        }
        $item->files = ['key' => $item->clitemsno, 'files' => $files];
        /*  return $item; */
        return [$item, $case, $checklist/* , $file */];
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

            $case = CPCase::where('id', $clitem->cf_1217)->firstOrFail();
            $checklist = Checklist::where('id', $clitem->cf_1216)->firstOrFail();

            if ($request->file('file')) {
                /* Multiple file upload */
                $files = $request->file('file');
                if (!is_array($files)) {
                    $files = [$files];
                }

                $fileList = array();
                $contact_no = $contact->contact_no;
                $destination = "documents/contact/$contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$clitem->clitemsno-$clitem->cf_1200";

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $filename = str_replace(' ', '', $filename);
                    $filename = str_replace('-', '_', $filename);

                    $file->storeAs("/public/$destination", $filename);
                    $fileUrl = "$destination/$filename";
                    array_push($fileList, $fileUrl);
                }
                /*  $clitem->status= 'pending';
                $clitem->save(); */

                return response()->json(["List" => $fileList, 200]);
            }
        } catch (\Exception $e) {
            return  response()->json(['message' => $e], 503);
        }
    }

    public function sendDocumentToImmcase(Request $request)
    {
        try {

            $vtiger = new Vtiger();
            $ex = explode('/', $request->file);
            /*
            $lastEl = array_pop((array_slice($ex, -1)));
            return $lastEl;
            */
            $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
            $clitem = $vtiger->search($clitemQuery);
            if (count($clitem->result) > 0) {
                $clitem = $clitem = $vtiger->search($clitemQuery)->result[0];
            }
            if ($clitem) {
                //get contact
                $contactQuery = DB::table('Contacts')->select('*')->where("id", $clitem->cf_contacts_id)->take(1);
                $contact = $vtiger->search($contactQuery)->result[0];
                $caseQuery = DB::table('HelpDesk')->select('*')->where("contact_id",  $contact->id)->take(1);
                $case = $vtiger->search($caseQuery)->result[0];
                $obj = $vtiger->retrieve($clitem->id);
                $obj->result->cf_1970 = end($ex);
                $obj->result->cf_1214 = "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs"; //GD Link
                $obj->result->cf_acf_rtf_1208 = "From cpp";
                $vtiger->update($obj->result);
                return response()->json(["Success", $obj], 200);
            }
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function deleteDocument(Request $request)
    {
        try {
            $file = $request->file;

            if (env('APP_ENV') === 'local') {
                $urlFile = "public/$file";
            } else {
                $urlFile = env('APP_URL') . Storage::url("app/public/$file"); // in prod
            }
            //it works /public/documents/contact/2156722/cases/A2145419-Work Permit/checklists/CL2141417-/clitems/CLI4002097-Document/simpsons.png

            if (Storage::exists($urlFile)) {
                Storage::delete($urlFile);
                return  response()->json("File removed from temporary storage");
            } else {
                return response()->json("File not found");
            }
        } catch (Exception $e) {
            return $e->getMessage();
            return response()->json([$e, 500]);
        }

        return $request;
    }

    public function updateCLItemFromImmcase(Request $request)
    {
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
