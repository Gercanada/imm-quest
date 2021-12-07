<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $vtiger = new Vtiger();
        //Get contact data of this user
        $userQuery = DB::table('Contacts')->select('id')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);
        //Cases
        $casesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id);
        $vtCases = $vtiger->search($casesQuery)->result;
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }
        //array_push($vtCasesIdArr, '17x3558'); //only test
        //Count cases
        $vt_active_cases =  count(array_keys($vtCases, ('Closed' || 'Cancelled' || 'Completed')));
        $vt_checklists  = 0;
        $vt_cl_items = [];
        $pending_checklists = [];

        if (count($vtCasesIdArr) >= 1) {
            $checklistsQuery = DB::table('Checklist')->select('*')
                ->whereIn('cf_1199', $vtCasesIdArr);

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

            if (count($vtCLItemIdArr) >= 1) {
                $clitemsQuery = DB::table('CLItems')->select('*')
                    ->whereIn('cf_1216', $vtCLItemIdArr)
                    ->orWhereIn('cf_1217', $vtCasesIdArr)
                    ->where('cf_1578', 'Pending')
                    ->where('cf_1200', 'Document');
                $vtCLItems    = $vtiger->search($clitemsQuery);
                $vt_cl_items = $vtCLItems->result;

                $pendingChecklistQuery = DB::table('Checklist')->select('*')
                    ->whereIn('cf_1199', $vtCasesIdArr) //TODO enable
                    ->where('cf_1187', '>=', '1')
                    ->where('cf_1189', '>=', '1');

                $checklists = $vtiger->search($pendingChecklistQuery)->result;
                $pending_checklists = array();

                $pendingArr = array();
                if (count($vt_cl_items) >= 1) {
                    foreach ($vt_cl_items as $item) {
                        $itemID = $item->cf_1216;
                        array_push($pendingArr, $item->cf_1216);
                    }

                    foreach ($checklists as $checklist) {
                        if (in_array($checklist->id, $pendingArr)) {
                            array_push($pending_checklists, $checklist);
                        }
                    }
                }
            }
        }


        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }

        //Invoices
        $invoiceQuery = DB::table('Invoice')->select('*')->where('contact_id',  $contact->result[0]->id);
        $invoices = $vtiger->search($invoiceQuery)->result;

        //return $invoices;
        $invoiceIdArr = [];
        foreach ($invoices as $invoice) {
            array_push($invoiceIdArr, $invoice->id);
        }

        // Get invoice payments
        $paymentsQuery = DB::table('Payments')->select('*')->where('cf_1139', $contact->result[0]->id)->orWhereIn('cf_1141', $invoiceIdArr)->orWhereIn('cf_1140', $vtCasesIdArr);
        $payments = $vtiger->search($paymentsQuery)->result;

        $paymentIdArr = [];
        foreach ($payments as $payment) {
            array_push($paymentIdArr, $payment->id);
        }


        $commboardQuery = DB::table('CommBoard')->select('*')
            ->whereIn('cf_2218', $vtCasesIdArr)
            ->orWhereIn('cf_2218', $paymentIdArr);

        $commboards    = $vtiger->search($commboardQuery)->result;

        return view('dashboard', compact(
            'vtCases',
            'vt_active_cases',
            'vt_checklists',
            'vt_cl_items',
            'pending_checklists',
            'commboards'
        ));
    }
}
