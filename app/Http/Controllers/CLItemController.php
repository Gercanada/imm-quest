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
use App\Http\Controllers\CloneDBController;
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
            //$task        = new CloneDBController;
            $now         = Carbon::now()->format('H:i:s');
            //$ex          = explode('/', $request->file);
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

            $obj->result->description = "File uploaded at: " . $now;
            $obj->result->cf_1898     = 'from_cp';
            $obj->result->cf_1214     = "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs"; //GD Link

            $vtiger->update($obj->result);
            //$task->updateCLItemFromImmcase($request);
            return response()->json("Success", 200);
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

    public function sendDocumentToImmcaseAsPostRequest(Request $request)
    {
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
