<?php

namespace App\Http\Controllers;

use App\Models\Commboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

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
        $userQuery = DB::table('Contacts')->select('id', 'firstname', 'lastname')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery)->result[0];

        //Cases
        $casesQuery = DB::table('HelpDesk')->select('*')->where('contact_id', $contact->id);
        $vtCases = $vtiger->search($casesQuery)->result;
        $vtCasesIdArr = [];
        $vtCasesNOArr = [];

        foreach ($vtCases as $case) {
            array_push($vtCasesIdArr, $case->id);
            array_push($vtCasesNOArr, $case->ticket_no);
        }
          //Invoices
          $invoiceQuery = DB::table('Invoice')->select('*')->where('contact_id',  $contact->id);
          $invoices = $vtiger->search($invoiceQuery)->result;

          //return $invoices;
          $invoiceIdArr = [];
          foreach ($invoices as $invoice) {
              array_push($invoiceIdArr, $invoice->id);
          }

          // Get invoice payments
          $paymentsQuery = DB::table('Payments')->select('*')->where('cf_1139', $contact->id)->orWhereIn('cf_1141', $invoiceIdArr)->orWhereIn('cf_1140', $vtCasesIdArr);
          $payments = $vtiger->search($paymentsQuery)->result;

          $paymentIdArr = [];
          $paymentNOArr = [];
          foreach ($payments as $payment) {
              array_push($paymentIdArr, $payment->id);
              array_push($paymentNOArr, $payment->cf_1142);
          }
          $commboardQuery = DB::table('CommBoard')->select('*')
              ->whereIn('cf_2218', $vtCasesIdArr) //find by case id
              ->orWhereIn('cf_2218', $paymentIdArr) //Find by payment id
              ///->orWhereIn('cf_2218', $paymentNOArr) //Find by payment id
              ->orWhereIn('cf_2218', $vtCasesNOArr); //find by caseNo

          $commboards    = $vtiger->search($commboardQuery)->result;

        return view('commboard.index', compact('commboards','contact'));
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
                'name' => 'required|max:255',
                'description' => 'required',
            ]);

            $user = Auth::user();
            $user_id = $user->id;

            $vtiger = new Vtiger();
            //Get contact data of this user
            $userQuery = DB::table('Contacts')->select('*')->where("contact_no", $user->vtiger_contact_id)->take(1);
            $contact = $vtiger->search($userQuery)->result[0];
            //return $contact;
            $vtiger = new Vtiger();
            $data = [
                "assigned_user_id"=> "19x29",
                "name"=> $request->subject,
                'cf_2218' => $request->threadid, //threadid
                'cf_2224' => "$contact->firstname $contact->lastname",
                'description' => $request->comment,
                'cf_2226'=>Carbon::today(),//timestamps
            ];
            //array_push($any, json_encode($data));
            $data = $vtiger->create( "CommBoard", $data);
            return redirect('/');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
