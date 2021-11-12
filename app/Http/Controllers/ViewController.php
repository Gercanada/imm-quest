<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function cases()
    {
        return view('cases.index');
    }
    public function checklists()
    {
        return view('checklists.index');
    }
    public function documents()
    {
        return view('documents.index');
    }
    public function commboard()
    {
        return view('commboard.index');
    }
    public function invoices()
    {
        return view('invoices.index');
    }
    public function payments()
    {
        return view('payments.index');
    }
    public function quotes()
    {
        return view('quotes.index');
    }
    public function show_case()
    {
        return view('cases.show');
    }
    public function show_checklist()
    {
        return view('checklists.show');
    }
    public function checklist_item()
    {
        return view('checklists.items.item-db-upload');
    }
    public function checklist_item_ef()
    {
        return view('checklists.items.item-dv-e-forms');
    }
    public function pending_quotes()
    {
        return view('quotes.details.pending');
    }
    public function accepted_quotes()
    {
        return view('quotes.details.accepted');
    }
    public function show_invoice()
    {
        return view('invoices.show');
    }

}
