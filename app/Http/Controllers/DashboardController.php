<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Contact;
use App\Models\CPCase;
use App\Models\Checklist;
use App\Models\CLItem;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Commboard;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        return view('dashboard');
    }
}