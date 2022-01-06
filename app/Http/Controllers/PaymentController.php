<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Contact;
use App\Models\CPCase;
use App\Models\Invoice;

class PaymentController extends Controller
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
        //Cases
        $vtCases = CPCase::where('contact_id', $contact->id)->get();
        $vtCasesIdArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
        }

        //Invoices
        $invoices = Invoice::where('contact_id',  $contact->id)->get();

        //return $invoices;
        $invoiceIdArr = [];
        foreach ($invoices as $invoice) {
            array_push($invoiceIdArr, $invoice->id);
        }

        // Get invoice payments
        $payments = Payment::where('cf_1139', $contact->id)->orWhereIn('cf_1141', $invoiceIdArr)->orWhereIn('cf_1140', $vtCasesIdArr)->get();

        return view('payments.index', compact('payments'));
    }
}
