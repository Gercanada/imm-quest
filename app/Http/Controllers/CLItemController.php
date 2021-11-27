<?php

namespace App\Http\Controllers;

use App\Models\CLItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

class CLItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function show(/* CLItem $cLItem, $id */Request $request)
    {
        $vtiger = new Vtiger();
        $clitemQuery =  DB::table('CLItems')->select('*')
            ->where('id', $request->id)
            ->take(1);

        $item = [];
        $case = [];
        $checklist = [];
        if (count(array_keys($vtiger->search($clitemQuery)->result)) !== 0) {
            $item = $vtiger->search($clitemQuery)->result[0];


            $casesQuery =  DB::table('HelpDesk')
                ->select('*')
                ->where(
                    'id',
                    $item->cf_1217
                )
                ->take(1);

            $case = $vtiger->search($casesQuery)->result[0];

            $checklistQuery =  DB::table('Checklist')
                ->select('*')
                ->where(
                    'id',
                    $item->cf_1216

                )
                ->take(1);

            $checklist = $vtiger->search($checklistQuery)->result[0];
        }


        return [$item, $case, $checklist];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function dvupload($id)
    {
        $vtiger = new Vtiger();
        $clitemQuery =  DB::table('CLItems')->select('*')
            ->where('id', $id)
            ->take(1);

        $cl_item = null;
        if (count(array_keys($vtiger->search($clitemQuery)->result)) !== 0) {
            $cl_item = $vtiger->search($clitemQuery)->result[0];
        }
        return view('checklists.items.item-dv-upload', compact('cl_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CLItem $cLItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CLItem  $cLItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CLItem $cLItem)
    {
        //
    }
}
