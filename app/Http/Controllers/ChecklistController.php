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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        /* $active_checklists = Checklist::where('user_id', $user_id)
            ->with('case')
            ->where('completed', '!=', 100)
            ->get();
        $completed_checklists = Checklist::where('user_id', $user_id)
            ->with('case')
            ->where('completed', 100)->get(); */
        $vtiger = new Vtiger();
        $userQuery = DB::table('Contacts')->select('id')->where("id", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        //Cases
        $casesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id);
        $vtCases = $vtiger->search($casesQuery)->result;
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }
        array_push($vtCasesIdArr, '17x3558'); //only test

        //Count CheckLists
        $checklistsQuery = DB::table('Checklist')->select('*')
            //->whereIn('cf_1199', $vtCasesIdArr)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist, $id)
    {
        /* $check_list = Checklist::where('id', $id)
            ->with('clitems')
            ->firstOrFail(); */
        //return $checklist;
        $vtiger = new Vtiger();
        $checklistsQuery = DB::table('Checklist')->select('*')
            ->where('id', $id)->take(1);
        $check_list    = $vtiger->search($checklistsQuery)->result[0];

        $clitemsQuery =  DB::table('CLItems')->select('*')
            ->where('cf_1216', $id)
            ;

        $clitems = $vtiger->search($clitemsQuery)->result;
        //return $clitems;

        return view('checklists.show', compact('check_list', 'clitems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        //
    }
}
