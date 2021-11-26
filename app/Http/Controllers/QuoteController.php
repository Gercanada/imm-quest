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
        $userQuery = DB::table('Contacts')->select('id')->where("id", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery);

        $quotesQuery = DB::table('Quotes')->select('*')
            //->where('contact_id', $contact->result[0]->id)
        ;
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

        // return[ $accepted_quotes, $open_quotes];
        /* $open_quotes = Quote::where('user_id', $user_id)
            ->where('accepted', false)
            ->get();


        $accepted_quotes = Quote::where('user_id', $user_id)
            ->where('accepted', true)
            ->get(); */

        return view('quotes.index', compact('open_quotes', 'accepted_quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote, $id)
    {
        // $get_quote = Quote::where('id', $id)/* ->with('payments') */->firstOrFail();

        // if ($get_quote->accepted) {
        //     return view('quotes.details.accepted', compact('get_quote'));
        // } else {
        //     return view('quotes.details.pending', compact('get_quote'));
        // }


        $vtiger = new Vtiger();
        $quotesQuery = DB::table('Quotes')->select('*')
            ->where('id', $id)
            ->take(1);
        $quote = $vtiger->search($quotesQuery)->result[0];

        //return $quote;
        if (
            $quote->quotestage == "3 - Accepted"
            || $quote->quotestage == "4 - Accepted - Converted to Invoice"
        ) {
            /*  array_push($vtQuotesAcceptedStates, $quote->quotestage); */
            return view('quotes.details.accepted', compact('quote'));
        } else
            if (
            $quote->quotestage !== "7 - Client Banned"
            || $quote->quotestage !== "6 - Client Not Interested"
        ) {
            return view('quotes.details.pending', compact('quote'));
        }
    }
    /*   public function accepted_quotes(Quote $quote, $id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
