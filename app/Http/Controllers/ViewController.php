<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
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
}
