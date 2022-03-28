<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Checklist;
use App\Models\CLItem;
use App\Models\CPCase;
use App\Models\Contact;
use Exception;

class CPCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //Get contact data of this user
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        //Cases
        $active_cases = CPcase::select('*')->where('contact_id', $contact->id)->where('ticketstatus', '!=', 'Completed')->get();
        $completed_cases =  CPcase::select('*')->where('contact_id', $contact->id)->where('ticketstatus', 'Completed')->get();
        return view('cases.index', compact('active_cases', 'completed_cases'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $contact = Contact::where('contact_no',  $user->vtiger_contact_id)->firstOrFail();

        $case =  CPcase::select('*')->where('id', $id)
            ->where('contact_id', $contact->id)
            ->firstOrFail();

        $checklists  = Checklist::where('cf_1199', $case->id) // case_id
            ->get();

        $vtCLItemIdArr = [];
        foreach ($checklists as $clist) {
            if ($clist->id != "") {
                array_push($vtCLItemIdArr, $clist->id);
            }
        }

        $clitems = [];
        if ($vtCLItemIdArr !== []) {
            $clitems  = CLItem::whereIn('cf_1216', $vtCLItemIdArr)->get();
        }
        return view('cases.show', compact('case', 'checklists', 'clitems'));
    }

    public function details($id)
    {
        $user = Auth::user();
        $case = CPCase::where('id', $id)->firstOrFail();
        $checklists = Checklist::where('cf_1199', $case->id)->get(); // case_id

        $vtCLItemIdArr = [];
        foreach ($checklists as $clist) {
            if ($clist->id != "") {
                array_push($vtCLItemIdArr, $clist->id);
            }
        }
        $clitems = [];

        if (count($vtCLItemIdArr) > 0) {
            $clitems  = CLItem::whereIn('cf_1216', $vtCLItemIdArr) //checklist_id
                ->orWhere('cf_1217',  $case->id)->get(); // case_id
        }

        return [$case, $checklists, $clitems];
    }

    static function getCase($vtiger, $id, $contactId)
    {
        try {
            $case      =  CPCase::where('id', $id)->where('contact_id', $contactId)->firstOrFail();
        } catch (Exception $e) {
            $caseQuery =  DB::table('HelpDesk')->select('*')->where("id", $id)->take(1);
            $case =  $vtiger->search($caseQuery)->result[0];
        }
        return $case ?: null;
    }
}
