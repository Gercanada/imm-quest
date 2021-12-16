<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Checklist;
use App\Models\CPCase;
use App\Models\Contact;
use App\Models\CLItem;

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
        $user_id = $user->id;
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
        $check_list = Checklist::where('id', $id)->firstOrFail();
        $clitems = CLItem::where('cf_1216', $id)->get();

        return view(
            'checklists.show',
            compact(
                'check_list',
                'clitems'
            )
        );
    }
}
