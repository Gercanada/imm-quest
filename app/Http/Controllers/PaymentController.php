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

        $userQuery = DB::table('Contacts')->select('id')
            ->where("id", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        $paymentsQuery = DB::table('Payments')->select('*')->where('cf_1139', $contact->result[0]->id);

        $payments = $vtiger->search($paymentsQuery)->result;

        return view('payments.index', compact('payments'));
    }
}
