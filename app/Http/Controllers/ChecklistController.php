<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\Checklist;
use App\Models\CPCase;
use App\Models\Contact;
use App\Models\CLItem;
use App\Models\User;
use Exception;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the checklist active and completed of a contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $contact  = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();

        //Cases
        $vtCases = CPCase::where('contact_id', $contact->id)->get();
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }

        //Count CheckLists
        $vtChecklists = Checklist::whereIn('cf_1199', $vtCasesIdArr)->get();

        $active_checklists = [];
        $completed_checklists = [];

        if ($vtChecklists !== []) {
            foreach ($vtChecklists as $checklist) {
                if ($checklist->cf_1179 !== 'Completed') {
                    array_push($active_checklists, $checklist);
                } else {
                    array_push($completed_checklists, $checklist);
                }
            }
        }
        return view('checklists.index', compact('active_checklists', 'completed_checklists'));
    }

    /**
     * Display the specified checklist.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist, $id)
    {
        $user = Auth::user();
        $contact = Contact::where('contact_no',  $user->vtiger_contact_id)->firstOrFail();
        $check_list = Checklist::where('id', $id)
            ->where('cf_contacts_id', $contact->id)
            ->firstOrFail();
        return view(
            'checklists.show',
            compact('check_list')
        );
    }

    /**
     * returns clitems of chechlist on vueview for checklist
     */
    public function checklistItems(Checklist $checklist, $id)
    {
        try {
            $user       = Auth::user();
            $cloneTask  = new CloneDBController();
            $vtiger     = new Vtiger();

            $contact    = $cloneTask->getTypeData($vtiger, 'contact_no', $user->vtiger_contact_id, 'Contacts', 'one');
            $check_list = $cloneTask->getTypeData($vtiger, 'cf_contacts_id', $contact->id, 'Checklist', 'one');
            $clitems    = $cloneTask->getTypeData($vtiger, 'cf_contacts_id', $contact->id, 'CLItems', 'all');

            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln("checklist $id , contact $contact->id");
            }

            foreach ($clitems as $item) {
                $case = $cloneTask->getTypeData($vtiger, 'id', $item->cf_1217, 'HelpDesk', 'one');
                $checklist = $cloneTask->getTypeData($vtiger, 'id', $item->cf_1216, 'Checklist', 'one');
                if (env('APP_ENV') === 'local') {
                    $this->consoleWrite()->writeln("case $case->id , checklist $checklist->id ");
                }
                $directory = "/documents/contact/$contact->contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/$item->clitemsno-$item->cf_1200";
                $dirFiles  = Storage::disk('public')->allFiles($directory);
                $files     = [];
                foreach ($dirFiles as $file) {
                    array_push($files, $file);
                }
                $item->files = ['key' => $item->clitemsno, 'files' => $files];
            }
            return response()->json([$check_list, $clitems]);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['ChecklistController' => 'ChecklistItems']);
        }
    }
}
