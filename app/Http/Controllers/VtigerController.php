<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\VtigerType;
use Exception;

class VtigerController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    public function index()
    {
        return view('admin.settings');
    }

    public function types(Request $request, $user_id)
    {
        // Get all Vtiger types
        $vtiger = new Vtiger();
        $data = $vtiger->listTypes();

        //List types enabled on laravel
        $CPTypes = VtigerType::where('user_id', $user_id)->get();

        //$CPTypes = VtigerType::all();
        $enableTipeArr = array();

        foreach ($CPTypes as $enabledType) {
            $typeArray = $enabledType->name;
            array_push($enableTipeArr, $typeArray);
        }
        // returns enableTipeArr (enabled types)

        $types = $data->result->types;
        $vt_types = array();
        foreach ($types as $type) {
            //$enabledArr = array();
            if (in_array($type, $enableTipeArr)) {
                $enabledObj = (object) array('name' => $type, 'active' => 1);
                array_push($vt_types, $enabledObj);
            } else {
                $enabledObj = (object) array('name' => $type, 'active' => 0);
                array_push($vt_types, $enabledObj);
            }
        }
        return $vt_types;
    }


    public function getType(Request $request, $type)
    {
        $vtiger = new Vtiger();
        $data = $vtiger->describe($type);
        return $data;
    }

    public function configTypes(Request $request)
    {
        try {

            if ($request->vtid) {
                $user = User::where('id', $request->id)->firstOrFail();
                $user->vtiger_contact_id = $request->vtid;
                $user->save();
            }

            $requestedTypes = $request->object;
            $vtiger = new Vtiger();
            $data = $vtiger->listTypes();

            $types = $data->result->types;
            $beDeleted  = [];

            $beDeleted = VtigerType::where("user_id", $request->id)->get();

            $namesArr = [];
            foreach ($beDeleted as $del) {
                array_push($namesArr, $del->name);
            }

            foreach ($types as $type) {
                if (in_array($type, $requestedTypes)) {
                    VtigerType::updateOrCreate(
                        ['name' => $type],
                        [
                            'user_id' => $request->id,
                            'is_active' => true
                        ]
                    );
                } else {

                    foreach ($namesArr as $name) {
                        if (!in_array($name, $requestedTypes)) {
                            VtigerType::where('name', $name)->delete();
                        }
                    }
                }
            }
            return response()->json('ok', 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function userTools()
    {


        $user_id = Auth::user()->id;
        $types = VtigerType::where('user_id', $user_id)->get();

        $nameTypes = [];
        foreach ($types as $type) {
            array_push($nameTypes, $type->name);
        }
        return $nameTypes;
    }

    public function goType($type, $where)
    {
        $vtiger = new Vtiger();
        //return $where;
        // /cf_2129

        $pieces = explode(",", $where);
        //return $pieces;

        // apply permissions
        if ($where == 'all') {
            $query = DB::table($type)->select('*');
            // $query = DB::table($type)->select('id', 'firstname', 'lastname')->where('firstname', 'John');
            $data = $vtiger->search($query);
            return $data;
        } else {
            $query = DB::table($type)->select('*')->where($pieces[0],$pieces[1]);
            $data = $vtiger->search($query);
            return  $data;
        }
    }
}
