<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

use App\Models\CPCase;
use App\Models\Checklist;
use App\Models\CLItem;
use App\Models\VtigerType;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $casesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id);
        $vtCases = $vtiger->search($casesQuery)->result;
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }
        array_push($vtCasesIdArr, '17x3558'); //only test
        //Count cases
        $vt_active_cases =  count(array_keys($vtCases, ('Closed' || 'Cancelled' || 'Completed')));
        //['Closed','Cancelled','Completed']

        //Count CheckLists
        $checklistsQuery = DB::table('Checklist')->select('*')->whereIn('cf_1199', $vtCasesIdArr);
        $vtChecklists    = $vtiger->search($checklistsQuery);
        $vt_checklists   = count(array_keys($vtChecklists->result));
        // count clitems
        $vtCLItemIdArr = [];
        $vtCLItemNoArr = [];

        foreach ($vtChecklists->result as $clist) {
            if ($clist->id != "") {
                array_push($vtCLItemIdArr, $clist->id);
            }
        }
        foreach ($vtChecklists->result as $clist) {
            if ($clist->checklistno != "") {
                array_push($vtCLItemNoArr, $clist->checklistno);
            }
        }
        //return $vtCLItemNoArr;

        $clitemsQuery = DB::table('CLItems')->select('*')->whereIn('cf_1216', $vtCLItemIdArr)->orWhereIn('cf_1217', $vtCasesIdArr);
        $vtCLItems    = $vtiger->search($clitemsQuery);
        $vt_cl_items = count(array_keys($vtCLItems->result));

        return view('dashboard', compact('vtCases', 'vt_active_cases', 'vt_checklists', 'vt_cl_items'));
    }
}
