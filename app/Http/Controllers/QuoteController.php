<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Quote;
use App\Models\Contact;
use App\Models\InstallmentTracker;

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
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        $vtquotes = Quote::select('*')->where('contact_id', $contact->id)->get();

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
     * Display the specified resource about quote, status, documents and payment lan.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quote = Quote::where('id', $id)->firstOrFail();
        $iTrackers = InstallmentTracker::where('cf_1175', $id)->get();
        $itDocuments = DB::table('vt_Documents')->select('*')->where('cf_quotes_id', $quote->id)->get();
        return view('quotes.show', compact('quote', 'iTrackers', 'itDocuments'));
    }
}
