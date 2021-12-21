<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\Commboard;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\CPCase;
use App\Models\Payment;

class CommboardController extends Controller
{
    /**
     * Show a list of comments between contact and immManager about following up on a contact.
     */
    public function index(){
        $user = Auth::user();
        $user_id = $user->id;

        $vtiger = new Vtiger();
        //Get contact data of this user
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();

        //Cases
        $vtCases = CPCase::where('contact_id', $contact->id)->get();
        $vtCasesIdArr = [];
        $vtCasesNOArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
            array_push($vtCasesNOArr, $case->ticket_no);
        }
          //Invoices
          $invoices =Invoice::where('contact_id',  $contact->id)->get();
          //return $invoices;
          $invoiceIdArr = [];
          foreach ($invoices as $invoice) {
              array_push($invoiceIdArr, $invoice->id);
          }

          // Get invoice payments
          $payments = Payment::where('cf_1139', $contact->id)->orWhereIn('cf_1141', $invoiceIdArr)->orWhereIn('cf_1140', $vtCasesIdArr)->get();

          $paymentIdArr = [];
          $paymentNOArr = [];
          foreach ($payments as $payment) {
              array_push($paymentIdArr, $payment->id);
              array_push($paymentNOArr, $payment->cf_1142);
          }
          $commboards = Commboard::whereIn('cf_2218', $vtCasesIdArr) //find by case id
              ->orWhereIn('cf_2218', $paymentIdArr) //Find by payment id
              ///->orWhereIn('cf_2218', $paymentNOArr) //Find by payment id
              ->orWhereIn('cf_2218', $vtCasesNOArr)->get(); //find by caseNo

              $threads = null;/*  Commboard::groupByRaw('cf_2218')
              ->whereIn('cf_2218', $vtCasesIdArr) //find by case id
              ->orWhereIn('cf_2218', $paymentIdArr) //Find by payment id
              ///->orWhereIn('cf_2218', $paymentNOArr) //Find by payment id
              ->orWhereIn('cf_2218', $vtCasesNOArr)->
              ->get(); //find by caseNo */

        return view('commboard.index', compact('commboards','threads','contact'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendComment(Request $request)
    {
        try {
           $request->validate([
                'subject' => 'required|max:255',
                'comment' => 'required',
            ]);

            $user = Auth::user();
            $user_id = $user->id;
            $vtiger = new Vtiger();
            //Get contact data of this user
            $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
            //return $contact;
            $vtiger = new Vtiger();
            $data = [
                'assigned_user_id'=> '19x29',
                'name'=> $request->subject,
                'cf_2218' => $request->threadid, //threadid
                'cf_2224' => "$contact->firstname $contact->lastname",
                'description' => $request->comment,
                'cf_2226'=>Carbon::today(),//timestamps
            ];
            //array_push($any, json_encode($data));

            Commboard::create($data);
            //$data = $vtiger->create("CommBoard", $data);
            return redirect('/');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
