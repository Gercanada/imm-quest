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
            $task        = new CloneDBController;
            $ex          = explode('/', $request->file);
            $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
            $clitem      = $vtiger->search($clitemQuery);

            if (!$clitem->success === true) {
                return response()->json("Clitem not fount", 404);
            }
            $clitem =  $vtiger->search($clitemQuery)->result[0];
            $contactQuery                 = DB::table('Contacts')->select('*')->where("id", $clitem->cf_contacts_id)->take(1);
            $contact                      = $vtiger->search($contactQuery)->result[0];
            $caseQuery                    = DB::table('HelpDesk')->select('*')->where("id",  $clitem->cf_1217)->take(1);
            $case                         = $vtiger->search($caseQuery)->result[0];
            $obj                          = $vtiger->retrieve($clitem->id);
            $obj->result->cf_1970         = end($ex);
            $obj->result->cf_1214         = "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs"; //GD Link
            $obj->result->cf_acf_rtf_1208 = "Document uploaded from customers portal";
           /*  $vtiger->update($obj->result);
            $task->updateCLItemFromImmcase($request); */
            return response()->json("Success", 200);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'sendDocumentToImmcase']);
        }
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
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'downloadFile']);
        }
    }
}
