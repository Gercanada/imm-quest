<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CPCase;
use App\Models\Checklist;
use App\Models\CLItem;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $cases = CPCase::where('user_id', $user_id)
            ->get();

        $checklists = Checklist::where('user_id', $user_id)
            ->where('completed', 100)->get()->count();

        $cl_items = CLItem::where('user_id', $user_id)
            ->where('status', 0)->get()->count();


        $active_cases = $cases->where('status', '1')->count();

      /*   return response()->json(
            [['cases' => $cases], ['checklists' => $checklists], ['cl_items' => $cl_items], ['active_cases' => $active_cases]]
        );
 */
        return view('dashboard', compact('active_cases', 'cases', 'checklists', 'cl_items'));
    }
}
