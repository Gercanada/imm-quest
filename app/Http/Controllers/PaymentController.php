<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

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
        $vtiger = new Vtiger();

        $userQuery = DB::table('Contacts')->select('id')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        // $paymentsQuery = DB::table('Payments')->select('*')->where('cf_1139', $contact->result[0]->id);
        //$payments = $vtiger->search($paymentsQuery)->result;

        //Cases
        $casesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->result[0]->id);
        $vtCases = $vtiger->search($casesQuery)->result;
        $vtCasesIdArr = [];

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

        return view('payments.index', compact('payments'));
    }
}
