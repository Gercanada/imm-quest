<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Models\Contact;
use App\Models\CPCase;
use App\Models\Payment;
use App\Models\InstallmentTracker;

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

        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
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

        $open_invoices = Invoice::where('contact_id', $contact->id)   //TODO Enable this
            ->whereIn('invoicestatus', $invoicesStatusOpen)->get();

        $paid_invoices = Invoice::where('contact_id', $contact->id) //TODO Enable this
            ->whereIn('invoicestatus', $invoicesStatusClosed)->get();

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
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        //Cases
        $vtCases = CPCase::where('contact_id', $contact->id)->get();
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }

        //Invoices
        $invoice = Invoice::where('id', $id)->firstOrFail();

        // Get invoice payments
        $payments = Payment::where('cf_1141', $invoice->id)->get();

        $paymentIdArr = [];
        foreach ($payments as $payment) {
            array_push($paymentIdArr, $payment->id);
        }

        $documents = DB::table('vt_Documents')->select('*')
            ->where('cf_2129', $invoice->id)
            ->orWhereIn('cf_1490', $paymentIdArr)
            ->orWhereIn('cf_1487', $vtCasesIdArr)->get();
        //Payment plan
        $iTrackers = InstallmentTracker::where('cf_1176', $id)->get();
        return view('invoices.show', compact('invoice', 'payments', 'documents', 'iTrackers'));
    }
}
