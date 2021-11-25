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
        $user_id = Auth::user()->id;

        /* $active_cases = CPCase::where('user_id', $user_id)
            ->where('status', 1)
            ->get();
        $completed_cases = CPCase::where('user_id', $user_id)
            ->where('status', 0)
            ->get(); */

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
    public function show(CPCase $cPCase, $id)
    {

        $user = Auth::user();
        $user_id = $user->id;

        /*   $case = CPCase::where('id', $id)->firstOrFail();


        $checklists = Checklist::where('case_id', $case->id)
            ->with('clitems')
            ->with('case')
            //->where('clitems.status', 'pending')
            ->get();
 */
        //here go
        $vtiger = new Vtiger();
        $casesQuery = DB::table('HelpDesk')->select('*')->where('id', $id)

            ->take(1);
        $case = $vtiger->search($casesQuery)->result[0];

        /*  $vtCasesIdArr = [];

        foreach ($case as $case) {
            array_push($vtCasesIdArr, $case->id);
        }
        array_push($vtCasesIdArr, '17x3558'); //only test */
        //return $case->id;

        //where('column', 'ilike', '%' . $value . '%')
        $checklistsQuery = DB::table('Checklist')
            ->where('cf_1199', $case->id)
            ->orWhere('cf_1199', '17x3558') //test
            ->select('*');
        //$checklists    = $vtiger->search($checklistsQuery);
        $checklists    = $vtiger->search($checklistsQuery)->result;

        //return $checklists;
        $vtCLItemIdArr = [];
        foreach ($checklists as $clist) {
            if ($clist->id != "") {
                array_push($vtCLItemIdArr, $clist->id);
            }
        }


        $clitemsQuery = DB::table('CLItems')
        ->select('*')
        ->where('clitemsno','!=','any'); //example
           /*  ->whereIn('cf_1216', $vtCLItemIdArr)
            ->orWhere('cf_1217',  $case->id); */
        $clitems    = $vtiger->search($clitemsQuery)->result;

       // return $clitems;


        return view('cases.show', compact('case', 'checklists', 'clitems'));
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
