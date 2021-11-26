<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Checklist;
use App\Models\CPCase;
use Illuminate\Http\Request;
use JBtje\VtigerLaravel\Vtiger;

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
        $user_id = $user->id;

        ///vamo a ver
        $vtiger = new Vtiger();
        //Get contact data of this user
        $userQuery = DB::table('Contacts')->select('id')->where("id", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        //Cases
        $activeCasesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id)->where('ticketstatus', '!=', 'Completed');
        $active_cases = $vtiger->search($activeCasesQuery)->result;

        $completedCasesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id)->where('ticketstatus', 'Completed');
        $completed_cases = $vtiger->search($completedCasesQuery)->result;
        return view('cases.index', compact('active_cases', 'completed_cases'));
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
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        $vtiger = new Vtiger();
        $casesQuery = DB::table('HelpDesk')->select('*')->where('id', $id)

            ->take(1);
        $case = $vtiger->search($casesQuery)->result[0];

        $checklistsQuery = DB::table('Checklist')
            ->where('cf_1199', $case->id) // case_id
            //->orWhere('cf_1199', '17x3558') //test
            ->orWhere('id', '43x9828') // test
            ->select('*');

        $checklists    = $vtiger->search($checklistsQuery)->result;

        $vtCLItemIdArr = [];
        foreach ($checklists as $clist) {
            if ($clist->id != "") {
                array_push($vtCLItemIdArr, $clist->id);
            }
        }
        //return $vtCLItemIdArr;
        $clitems = [];
        if ($vtCLItemIdArr !== []) {
            $clitemsQuery = DB::table('CLItems')
                ->select('*')
                ->whereIn('cf_1216', $vtCLItemIdArr) //checklist_id
                //->orWhere('cf_1217',  $case->id) // case_id
            ;
            $clitems    = $vtiger->search($clitemsQuery)->result;
        }
        //return [$case,$clitems, $clitems];

        return view('cases.show', compact('case', 'checklists', 'clitems'));
    }

    public function details($id)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $vtiger = new Vtiger();
        $casesQuery = DB::table('HelpDesk')->select('*')->where('id', $id)
            ->take(1);
        $case = $vtiger->search($casesQuery)->result[0];

        $checklistsQuery = DB::table('Checklist')
            ->where('cf_1199', $case->id) // case_id
            //->orWhere('cf_1199', '17x3558') //test
            ->orWhere('id', '43x9828') // test
            ->select('*');

        $checklists    = $vtiger->search($checklistsQuery)->result;

        $vtCLItemIdArr = [];
        foreach ($checklists as $clist) {
            if ($clist->id != "") {
                array_push($vtCLItemIdArr, $clist->id);
            }
        }
        //return $vtCLItemIdArr;
        $clitems = [];
        if ($vtCLItemIdArr !== []) {
            $clitemsQuery = DB::table('CLItems')
                ->select('*')
                ->whereIn('cf_1216', $vtCLItemIdArr) //checklist_id
                //->orWhere('cf_1217',  $case->id) // case_id
            ;
            $clitems    = $vtiger->search($clitemsQuery)->result;
        }
        return [$case, $checklists, $clitems];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function edit(CPCase $cPCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CPCase $cPCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(CPCase $cPCase)
    {
        //
    }
}
