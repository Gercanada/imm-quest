<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\CPCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CPCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $active_cases = CPCase::where('user_id', $user_id)
            ->where('status', 1)
            ->get();
        $completed_cases = CPCase::where('user_id', $user_id)
            ->where('status', 0)
            ->get();

        /*  $active_cases = $cases->where('status', '1')->count(); */

        /*
        return response()->json([$active_cases, $completed_cases]); */
        return view('cases.index', compact('active_cases', 'completed_cases'));
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
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function show(CPCase $cPCase, $id)
    {

        $user_id = Auth::user()->id;

        $case = CPCase::where('id', $id)->firstOrFail();

        $checklists = Checklist::where('case_id', $case->id)
        ->with('clitems')
        ->with('case')
        //->where('clitems.status', 'pending')
        ->get();

        return view('cases.show', compact('case', 'checklists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function edit(CPCase $cPCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CPCase $cPCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CPCase  $cPCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(CPCase $cPCase)
    {
        //
    }
}
