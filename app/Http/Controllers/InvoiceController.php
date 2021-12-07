<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Http\Request;

use App\Models\Invoice;

class InvoiceController extends Controller
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
        $vtiger = new Vtiger();

        $userQuery = DB::table('Contacts')->select('id')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        //Invoices
        $invoicesStatusOpen = [
            "20 - On Track - Original Payment Plan",
            "35 - On Track - Last Payment until Decision"
        ];

        $invoicesStatusClosed = [
            "25 - On Track - Final Payment",
            "35 - On Track - Last Payment until Decision",
            "70 - Closed - Paid in Full"
        ];

        $OpenInvoicesQuery = DB::table('Invoice')->select('*')
            ->where('contact_id', $contact->result[0]->id)   //TODO Enable this
            ->whereIn('invoicestatus', $invoicesStatusOpen);
        $open_invoices = $vtiger->search($OpenInvoicesQuery)->result;

        $closedInvoicesQuery = DB::table('Invoice')->select('*')
            ->where('contact_id', $contact->result[0]->id) //TODO Enable this
            ->whereIn('invoicestatus', $invoicesStatusClosed);
        $paid_invoices = $vtiger->search($closedInvoicesQuery)->result;

        return view('invoices.index', compact('open_invoices', 'paid_invoices'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice, $id)
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

        //Invoices
        $invoiceQuery = DB::table('Invoice')->select('*')->where('id', $id);
        $invoice = $vtiger->search($invoiceQuery)->result[0];

        // Get invoice payments
        $paymentsQuery = DB::table('Payments')->select('*')->where('cf_1141', $invoice->id);
        $payments = $vtiger->search($paymentsQuery)->result;

        $paymentIdArr = [];
        foreach ($payments as $payment) {
            array_push($paymentIdArr, $payment->id);
        }

        $documentsQuery = DB::table('Documents')->select('*')
            ->where('cf_2129', $invoice->id)
            ->orWhereIn('cf_1490', $paymentIdArr)
            ->orWhereIn('cf_1487', $vtCasesIdArr);
        $documents = $vtiger->search($documentsQuery)->result;

        //Payment plan
        $itrackerQuery = DB::table('InstallmentTracker')->select('*')->where('cf_1176', $id);
        $iTrackers = $vtiger->search($itrackerQuery)->result;
        return view('invoices.show', compact('invoice', 'payments', 'documents', 'iTrackers'));
    }
}
