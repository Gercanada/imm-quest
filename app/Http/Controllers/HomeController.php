<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*    public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.app');
        // return view('home');
    }


    public function tempData()
    {

        $alldata = json_decode(file_get_contents(storage_path() . "/temp-data.json"), true);
        // return $alldata;
        $tabla = $alldata['Tabla'];

        $ages = [];

        foreach ($tabla as $key => $item) {
            foreach ($item as $key => $inner) {
                // return $key==="Sub Facto" ? "true" : "false";
                //  return [$key => $inner];
                if ($key === "Sub Facto" && $inner === "Age") {
                    // return $item;
                    array_push($ages, ['Criterion' => $item['Criterion'], 'Single' => $item['Single'], 'Married' => $item['Married']]);
                }
            }
        }

        return response()->json($ages);
        // return view('home');
    }
}
