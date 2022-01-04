<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Contact;
use App\Models\CPCase;
use App\Models\Checklist;
use App\Models\CLItem;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Commboard;


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
        $contact = Contact::select('id', 'firstname', 'lastname')->where("contact_no", $user->vtiger_contact_id)->firstOrFail();

        //Cases
        $vtCases = CPCase::select('*')->where('contact_id', $contact->id)->get();
        $vtCasesIdArr = [];
        $vtCasesNOArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
            array_push($vtCasesNOArr, $case->ticket_no);
        }
        //Count cases
        $vt_active_cases =  count($vtCases/* , ('Closed' || 'Cancelled' || 'Completed') */);
        $vt_checklists  = 0;
        $vt_cl_items = [];
        $pending_checklists = [];

        if (count($vtCasesIdArr) > 0) {
            $vtChecklists = Checklist::select('*')->whereIn('cf_1199', $vtCasesIdArr)->get();
            $vt_checklists   = count($vtChecklists);
            // count clitems
            $vtCLItemIdArr = [];
            $vtCLItemNoArr = [];

            foreach ($vtChecklists as $clist) {
                if ($clist->id != "") {
                    array_push($vtCLItemIdArr, $clist->id);
                }
                if ($clist->checklistno != "") {
                    array_push($vtCLItemNoArr, $clist->checklistno);
                }
            }

            if (count($vtCLItemIdArr) > 0) {
                $vt_cl_items  = CLItem::select('*')
                    ->orWhereIn('cf_1216', $vtCLItemIdArr)
                    ->orWhereIn('cf_1217', $vtCasesIdArr)
                    ->where('cf_1578', 'Pending')
                     ->where('cf_1200', 'Document')
                    ->get();
                $pending_checklists = [];

                $pendingArr = [];
                $pendingArr2 = [];
                if (count($vt_cl_items) >0) {
                    foreach ($vt_cl_items as $item) {
                        // /$itemID = $item->cf_1216;
                        array_push($pendingArr, $item->cf_1216);
                        array_push($pendingArr2, $item->id);
                    }
                    foreach ($vtChecklists as $checklist) {
                        if (($checklist != null) && (in_array($checklist->id, $pendingArr))) {
                            array_push($pending_checklists, $checklist);
                        }
                    }
                }
            }
        }

        //Invoices
        $invoices = Invoice::select('*')->where('contact_id',  $contact->id)->get();

        $invoiceIdArr = [];
        foreach ($invoices as $invoice) {
            array_push($invoiceIdArr, $invoice->id);
        }

        // Get invoice payments
        $payments = Payment::select('*')->where('cf_1139', $contact->id)->orWhereIn('cf_1141', $invoiceIdArr)->orWhereIn('cf_1140', $vtCasesIdArr)->get();
        $paymentIdArr = [];
        $paymentNOArr = [];
        foreach ($payments as $payment) {
            array_push($paymentIdArr, $payment->id);
            array_push($paymentNOArr, $payment->cf_1142);
        }
        $commboards = Commboard::WhereIn('cf_2218', $vtCasesIdArr)->get();

        return view('dashboard', compact(
            'vtCases',
            'vt_active_cases',
            'vt_checklists',
            'vt_cl_items',
            'pending_checklists',
            'commboards',
            'contact'
        ));
    }
}
