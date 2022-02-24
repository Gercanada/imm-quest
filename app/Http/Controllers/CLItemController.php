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
use Illuminate\Support\Carbon;
use Exception;


class CLItemController extends Controller
{
    /*
     $this->consoleWrite()->writeln("hello"); // for print in run console */
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $contact = Contact::where('contact_no',  $user->vtiger_contact_id)->firstOrFail();

        $item = CLItem::where('id', $request->id)
            ->where('cf_contacts_id', $contact->id)
            ->firstOrFail();
        $case =  CPCase::where('id', $item->cf_1217)
            ->where('contact_id', $contact->id)
            ->firstOrFail();
        $checklist =  Checklist::where('id', $item->cf_1216)
            ->where('cf_contacts_id', $contact->id)
            ->firstOrFail();

        $directory = "/documents/contact/$contact->contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$item->clitemsno-$item->cf_1200";
        $dirFiles = Storage::disk('public')->allFiles($directory);
        $files = [];
        $itemfiles = [];
        foreach ($dirFiles as $file) {
            array_push($files, $file);
        }

        $itemfiles = ['key' => $item->clitemsno, 'files' => $files];
        $item->files = $itemfiles;
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
        $user = Auth::user();
        $contact = Contact::where('contact_no',  $user->vtiger_contact_id)->firstOrFail();
        $cl_item =   CLItem::where('id', $id)->where('cf_contacts_id', $contact->id)->firstOrFail();
        if ($cl_item->cf_1200 === "Questionnaire") {
            return view('checklists.items.questionnaire', compact('cl_item'));
        }
        return view('checklists.items.item-dv-upload', compact('cl_item'));
    }


    public function survey($id)
    {
        $user = Auth::user();
        $contact = Contact::where('contact_no',  $user->vtiger_contact_id)->firstOrFail();
        $cl_item =   CLItem::where('id', $id)->where('cf_contacts_id', $contact->id)->firstOrFail();

        return $cl_item;

        if ($cl_item->cf_1200 === "Questionnaire") {
            return view('checklists.items.questionnaire', compact('cl_item'));
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
            $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
            $clitem = CLItem::where('id', $request->id)
                ->where('cf_contacts_id', $contact->id)->firstOrFail();

            $case = CPCase::where('id', $clitem->cf_1217)
                ->where('contact_id', $contact->id)
                ->firstOrFail();

            $checklist = Checklist::where('id', $clitem->cf_1216)
                ->where('cf_contacts_id', $contact->id)
                ->firstOrFail();
            /* Multiple file upload */
            $files = $request->file('file');

            if (!is_array($files)) {
                $files = [$files];
            }
            $fileList = [];
            $contact_no = $contact->contact_no;
            $destination = "documents/contact/$contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$clitem->clitemsno-$clitem->cf_1200";

            if ($request->category === 'eform') {
                $destination = "documents/contact/$contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/eforms/$clitem->clitemsno-$clitem->cf_1200";
            }

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $filename = str_replace(' ', '', $filename);
                $filename = str_replace('-', '_', $filename);
                $file->storeAs("/public/$destination", $filename);
                $fileUrl = "$destination/$filename";
                array_push($fileList, $fileUrl);
            }
            return response()->json($fileList, 200);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'uploadFile']);
        }
    }

    public function sendDocumentToImmcase(Request $request)
    {
        try {
            $vtiger      = new Vtiger();
            $now         = Carbon::now()->format('H:i:s');
            //$ex          = explode('/', $request->file);
            $oncpItem = CLItem::where("clitemsno", $request->clitemsno)->firstOrFail();
            $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
            $clitem      = $vtiger->search($clitemQuery);

            if (!$clitem->success === true) {
                return response()->json("Clitem not fount", 404);
            }

            $clitem =  $vtiger->search($clitemQuery)->result[0];

            $contactQuery    = DB::table('Contacts')->select('*')->where("id", $clitem->cf_contacts_id)->take(1);
            $contact         = $vtiger->search($contactQuery)->result[0];
            $caseQuery       = DB::table('HelpDesk')->select('*')->where("id",  $clitem->cf_1217)->take(1);
            $case            = $vtiger->search($caseQuery)->result[0];

            $obj  = $vtiger->retrieve($clitem->id);
            if ($obj->result->cf_1898 === 'from_cp' || ($obj->result->cf_1578 != $oncpItem->cf_1578)) {
                return response()->json("waiting");
            }

            $obj->result->description = "File uploaded at: " . $now;
            $obj->result->cf_1898     = 'from_cp';
            $obj->result->cf_1214     = "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs"; //GD Link

            $vtiger->update($obj->result);
            //$task->updateCLItemFromImmcase($request);
            return response()->json("success", 200);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'sendDocumentToImmcase']);
        }
    }

    static function checkItemFile($contact, $case, $checklist, $clitem)
    {
        $directory  = "/documents/contact/$contact/cases/$case/checklists/$checklist/clitems/$clitem";
        $files      = Storage::disk('public')->allFiles($directory);
        $urlFiles   = [];
        foreach ($files as $file) {
            if (env('APP_ENV') === 'local') {
                array_push($urlFiles, (Storage::url($file)));
            } else {
                array_push($urlFiles, (Storage::url("app/public/$file"))); // in prod
            }
        }
        return $urlFiles;
    }


    public function deleteDocument(Request $request)
    {
        try {
            $file = $request->file;
            $urlFile = "public/$file";


            if (Storage::exists($urlFile)) {
                Storage::delete($urlFile);
                return  response()->json("File removed from temporary storage", 200);
            } else {
                return response()->json("File not found at " . $urlFile, 403);
            }
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'deleteDocument']);
        }
    }


    public function downloadFile($contact)
    {
        try {
            $directory = "/documents/contact/$contact";
            $files     = Storage::disk('public')->allFiles($directory);
            $urlFiles  = [];

            foreach ($files as $file) {
                if (env('APP_ENV') === 'local') {
                    array_push($urlFiles, (Storage::url($file)));
                } else {
                    array_push($urlFiles, (Storage::url("app/public/$file"))); // in prod
                }
            }
            return $urlFiles;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'downloadFile']);
        }
    }
}


/*
    vtiger workflow for upload files when clittem is updaed from cp
    can import this wrorkflow using on vtiger workflow designer with the option "import blocks as text"
    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
*/
