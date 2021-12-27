<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\Commboard;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\CPCase;
use App\Models\Payment;

use Faker\Factory as Faker;

class CommboardController extends Controller
{
    /**
     * Show a list of comments between contact and immManager about following up on a contact.
     */
    public function index(){
        return view('commboard.index');
    }

    /**
     * This method returns a list of comments for the client to follow up on activities related to their paperwork process.
     * The administrator of the process makes comments about a certain process and the client can add answers.
     * Comments are grouped based on the thread they track
     */
    public function getComments(){
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

              return [ $commboards, $contact ];
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
            //Get contact data of this user
            $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();


            $faker = Faker::create();
                //return $faker->numberBetween(0,99);
            $newId =$faker->numberBetween(0,99).'x'.$faker->numberBetween(0,99999);

            $founded =false;
            while($founded === true){
                $founded = Commboard::where('id',$newId)->firstOrFail();
                $newId ="_x$faker->numberBetween(0,99999)";
            }

            $data = [
                'id'=>$newId,
                'assigned_user_id'=> '19x29',
                'name'=> $request->subject,
                'cf_2220'=>$request->threadtype,
                'cf_2218' => $request->threadid, //threadid
                'cf_2224' => "$contact->firstname $contact->lastname",
                'description' => $request->comment,
                'cf_2226'=>Carbon::today()->format('Y-m-d'),//timestamps
                'cf_2228'=>Carbon::now()->format('H:i:s'),//timestamps
                'modifiedby'=>$contact->id,
                'createdtime'=>Carbon::now()->format('Y-m-d H:i:s')
            ];
            //array_push($any, json_encode($data));

            Commboard::create($data);
            //$data = $vtiger->create("CommBoard", $data);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
