<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

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
        $vtiger = new Vtiger();
        $userQuery = DB::table('Contacts')->select('id')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        //Cases
        $casesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id);
        $vtCases = $vtiger->search($casesQuery)->result;
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }
        ///array_push($vtCasesIdArr, '17x3558'); //only test

        //Count CheckLists
        $checklistsQuery = DB::table('Checklist')->select('*')
            ->whereIn('cf_1199', $vtCasesIdArr)
            //->Where('id', '43x9828') // test
        ;
        $vtChecklists    = $vtiger->search($checklistsQuery)->result;

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
        $vtiger = new Vtiger();
        $checklistsQuery = DB::table('Checklist')->select('*')
            ->where('id', $id)
            ->take(1);
        $check_list    = $vtiger->search($checklistsQuery)->result[0];
        $clitemsQuery =  DB::table('CLItems')->select('*')
            ->where('cf_1216', $id);

        $clitems = $vtiger->search($clitemsQuery)->result;

        return view(
            'checklists.show',
            compact(
                'check_list',
                'clitems'
            )
        );
    }
}
