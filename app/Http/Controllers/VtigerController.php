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

        return $data;

        //List types enabled on laravel
        $CPTypes = VtigerType::where('user_id', $user_id)->get();

        //$CPTypes = VtigerType::all();
        $enableTipeArr = array();
        if (sizeof($enableTipeArr) >= 1) {
            foreach ($CPTypes as $enabledType) {
                $typeArray = $enabledType->name;
                array_push($enableTipeArr, $typeArray);
            }
        }
        // returns enableTipeArr (enabled types)

        $types = $data->result->types;
        $vt_types = array();
        foreach ($types as $type) {
            //$enabledArr = array();
            if (in_array($type, $enableTipeArr) && sizeof($enableTipeArr) >= 1) {
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



    public function goType($type, $where)
    {
        $user  = Auth::user();
        $vtiger = new Vtiger();

        $data = null;
        // apply permissions
        if ($where === 'types') {
            $data = $vtiger->listTypes();
            $types = $data->result->types;
            $data = $types;
        }
        if ($where == 'all') {
            $query = DB::table($type)->select('*')/* ->where('clitemsno','CLI4002052') */;
            // $query = DB::table($type)->select('id', 'firstname', 'lastname')->where('firstname', 'John');
            $data = $vtiger->search($query);
        }
        if ($where === 'rel') {
            $query = null;
            if ($type === 'CLItems') {
                $query = DB::table($type)->select('*')->where("clitemsno", "CLI4002176");
            }
            if ($type === 'HelpDesk') {
                $query = DB::table($type)->select('*')->where("ticket_no", "A2245485");
            }
            if ($type === 'Documents') {
                $query = DB::table($type)->select('*')->where("assigned_user_id", "19x29");
            }
            if ($type === 'Checklist') {
                $ids = [
                    '43x65454',
                    '43x65477',
                    '43x66740',
                    '43x67847',
                    '43x71108',
                    '43x76721'
                ];
                $query = DB::table($type)->select('*')->whereIn("id", $ids);
                // $query = DB::table($type)->select('*')->where("checklistno", "CL2141422");
            }
            if ($type === 'Invoice') {
                $query = DB::table($type)->select('*')->where("assigned_user_id", "19x29");
            }
            if ($type === 'Quotes') {
                $query = DB::table($type)->select('*')->where("contact_id", "12x65450")->orWhere('assigned_user_id', "19x29")->orWhere('quote_no', 'PS2150558');
            }
            if ($type === 'Contacts') {
                $query = DB::table($type)->select('*')->where('id', "12x65450")->orWhere("assigned_user_id", "19x29");
            }
            if ($type === 'DocumentFolders') {
                $query = DB::table($type)->select('*')->where('id', "12x65450")->orWhere("assigned_user_id", "19x29");
            }

            $data = $vtiger->search($query);
        }
        return  $data;
    }
}
/*
$today = date("Y-m-d H:i:s");
if($createdtime === $modifiedtime){
    return "Case created at ".$today;
}else{
    return "Case updated at ".$today;
}
 */
