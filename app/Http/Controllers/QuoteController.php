<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

class QuoteController extends Controller
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

        $quotesQuery = DB::table('Quotes')->select('*')->where('contact_id', $contact->result[0]->id);
        $vtquotes = $vtiger->search($quotesQuery)->result;

        $vtQuotesAcceptedStates = [];
        $vtQuotesOpenedStates = [];

        foreach ($vtquotes as $quote) {
            if (
                $quote->quotestage == "3 - Accepted"
                || $quote->quotestage == "4 - Accepted - Converted to Invoice"
            ) {
                array_push($vtQuotesAcceptedStates, $quote->quotestage);
            } else
            if (
                $quote->quotestage !== "7 - Client Banned"
                || $quote->quotestage !== "6 - Client Not Interested"
            ) {
                array_push($vtQuotesOpenedStates, $quote->quotestage);
            }
        }

        $open_quotes = [];
        $accepted_quotes = [];

        foreach ($vtquotes as $quote) {
            if (in_array($quote->quotestage, $vtQuotesAcceptedStates)) {
                array_push($accepted_quotes, $quote);
            } elseif (in_array($quote->quotestage, $vtQuotesOpenedStates)) {
                array_push($open_quotes, $quote);
            }
        }
        return view('quotes.index', compact('open_quotes', 'accepted_quotes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote, $id)
    {
        $vtiger = new Vtiger();
        $quotesQuery = DB::table('Quotes')->select('*')
            ->where('id', $id)
            ->take(1);
        $quote = $vtiger->search($quotesQuery)->result[0];

        $itrackerQuery = DB::table('InstallmentTracker')->select('*')
        ->where('cf_1175', $id);

        $iTrackers = $vtiger->search( $itrackerQuery)->result;


        $itDocumentQuery = DB::table('Documents')->select('*')
        ->where('cf_1488', $quote->contact_id);

        $itDocuments = $vtiger->search( $itDocumentQuery)->result;

        if (
            $quote->quotestage == "3 - Accepted"
            || $quote->quotestage == "4 - Accepted - Converted to Invoice"
        ) {
            /*  array_push($vtQuotesAcceptedStates, $quote->quotestage); */
            return view('quotes.details.accepted', compact('quote','iTrackers', 'itDocuments'));
        } else
            if (
            $quote->quotestage !== "7 - Client Banned"
            || $quote->quotestage !== "6 - Client Not Interested"
        ) {
            return view('quotes.details.pending', compact('quote' ,'iTrackers','itDocuments'));
        }
    }
}
