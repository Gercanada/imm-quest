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

        $survey = [];
        if ($item->cf_1200 === "Questionnaire" && $item->cf_1212 != '') {
            $lime = new LSurveyController();
            $id = $item->id;
            $survey = $lime->survey($request, $id); //Start limesurvey session
        }

        $directory = "/documents/contact/$contact->contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$item->clitemsno-$item->cf_1200";
        $directory = str_replace(' ', '_', $directory);
        $dirFiles = Storage::disk('public')->allFiles($directory);
        $files = [];
        $itemfiles = [];
        foreach ($dirFiles as $file) {
            array_push($files, $file);
        }

        $itemfiles = ['key' => $item->clitemsno, 'files' => $files];
        $item->files = $itemfiles;
        return [$item, $case, $checklist, $survey];
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
        /*  if ($cl_item->cf_1200 === "Questionnaire") {
            return view('checklists.items.questionnaire', compact('cl_item'));
        } */
        return view('checklists.items.item-dv-upload', compact('cl_item'));
    }





    /**
     * This method allows upload files related with clitem
     */
    public function uploadFile(Request $request)
    {
        try {
            $user    = Auth::user();
            $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
            $clitem  = CLItem::where('id', $request->id)
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
            $destination = str_replace(' ', '_', $destination);

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $filename = str_replace(' ', '', $filename);
                $filename = str_replace('-', '_', $filename);
                $file->storeAs("/public/$destination", $filename);
                $fileUrl = "$destination/$filename";
                array_push($fileList, $fileUrl);
            }
            return response()->json(200);
            return response()->json($fileList, 200);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['CLItemController' => 'uploadFile']);
        }
    }

    public function sendDocumentToImmcase(Request $request)
    {
        try {

            $user        = Auth::user();
            $vtiger      = new Vtiger();
            $docsTask    = new DocumentController();
            $task        = new CloneDBController();
            $now         = Carbon::now()->format('H:i:s');
            //$ex        = explode('/', $request->file);
            $oncpItem    = CLItem::where("clitemsno", $request->clitemsno)->firstOrFail(); //Find Record on cp

            //CLItem,
            $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
            $clitem      = $vtiger->search($clitemQuery);
            if (!$clitem->success) {
                return response()->json("Clitem not fount", 404);
            }
            $clitem =  $vtiger->search($clitemQuery)->result[0];
            //Checklist
            $checklistQuery    = DB::table('Checklist')->select('*')->where("id", $clitem->cf_1216)->take(1);
            $checklist         = $vtiger->search($checklistQuery);
            if (!$checklist->success) {
                return response()->json("Checklist not fount", 404);
            }
            $checklist         = $vtiger->search($checklistQuery)->result[0];


            //Contact
            $contactQuery    = DB::table('Contacts')->select('*')->where("id", $clitem->cf_contacts_id)->take(1);
            $contact         = $vtiger->search($contactQuery);
            if (!$contact->success) {
                return response()->json("Contact not fount", 404);
            }
            $contact         = $vtiger->search($contactQuery)->result[0];

            //Case
            $caseQuery       = DB::table('HelpDesk')->select('*')->where("id",  $clitem->cf_1217)->take(1);
            $case            = $vtiger->search($caseQuery);
            if (!$case->success) {
                return response()->json("case not fount", 404);
            }
            $case   = $vtiger->search($caseQuery)->result[0];
            //here ok

            $obj  = $vtiger->retrieve($clitem->id);

            $request->request->add(['cid'       => $user->vtiger_contact_id]);
            $request->request->add(['case'      => $case->ticket_no . '-' . $case->ticketcategories]);
            $request->request->add(['checklist' => $checklist->checklistno . '-' . $checklist->cf_1706]);
            $request->request->add(['clitem'    => $clitem->clitemsno . '-' . $clitem->cf_1200]);

            $files =  $docsTask->checkDocuments($request);
            $arrAsStr = implode(', ', $files);

            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln($arrAsStr);
            }

            $obj->result->description = "File uploaded at: " . $now;
            $obj->result->cf_2370     = $arrAsStr; //set on metadata field

            $newFilePath =  str_replace(" ", "_", "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs");
            $obj->result->cf_1214     = $newFilePath; //GD Link
            $vtiger->update($obj->result);
            sleep(8);

            $obj2  = $vtiger->retrieve($clitem->id);
            do {
                if ($obj2->result->cf_1578 === "Received") {
                    $updatedItem = $task->updateCLItemFromImmcase($request);
                    $task->updateChecklistFromImmcase($request);

                    $urls = explode(', ', $updatedItem->cf_2370);
                    foreach ($urls as  $url) {
                        $request->request->add(['file' => $url]);
                        $docsTask->destroy($request);
                    }
                } else {
                    sleep(3);
                    $obj2  = $vtiger->retrieve($clitem->id);
                }
            } while ($obj2->result->cf_1578 != "Received");

            return $updatedItem;
            return response()->json("success", 200);
        } catch (Exception $e) {
            return $e;
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

    Workig with delays at 2022-02-25
    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

    try to customize workflow with less delays


    ${ $ex  = explode(', ', $cf_2370) ;  return   strlen($ex[0]); }}>
*/
/* $ex  = explode(', ', $cf_2370);
if (
    (count($ex) > 1) && (strlen($ex[0]) > 5) &&
    ($cf_1578 === "Pending" || $cf_1578 === "Replacement Needed")
) {
    return 'yes';
} else {
    return 'no';
}
 */
/*
${ $ex  = explode(', ', $cf_2370);

    if ((count($ex) > 0) && (strlen($ex[0]) > 5)
    &&     ($cf_1578 === "Pending" || $cf_1578 === "Replacement Needed") )
     {     return 'yes';

     }}}> */

/* 
$env["server_url"] = "https://4ee2-187-212-180-149.ngrok.io";
if ($cf_2370 != null) {
    $eachFile = explode(', ', $cf_2370);

    $fileUrl =  $env["server_url"] . $eachFile[$loop];
    $headers = get_headers($fileUrl);
    if ($headers && strpos($headers[0], '200')) {
        $env["simpleurl"] = $fileUrl;
    }else{
        $env["simpleurl"] = $headers;
    }
}
return 'yes'; */
