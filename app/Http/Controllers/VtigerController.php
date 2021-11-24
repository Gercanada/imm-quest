<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JBtje\VtigerLaravel\Vtiger;
use App\Models\VtigerType;

class VtigerController extends Controller
{
    public function index()
    {
        // Get all Vtiger types
        /*  $vtiger = new Vtiger();
        $data = $vtiger->listTypes();

        //List types enabled on laravel
        $CPTypes = VtigerType::all();
        $enableTipeArr = array();

        foreach ($CPTypes as $enabledType) {
            $typeArray = $enabledType->name;
            array_push($enableTipeArr, $typeArray);
        }
        // returns enableTipeArr (enabled types)

        $types = $data->result->types;

        //$enabled_types = array();
        $vt_types = array();
        foreach ($types as $type) {
            $enabledArr = array();

            if (in_array($type, $enableTipeArr)) {
                $enabledObj = (object) array('name' => $type, 'active' => 1);
                array_push($vt_types, $enabledObj);
            } else {
                $enabledObj = (object) array('name' => $type, 'active' => 1);
                array_push($vt_types, $enabledObj);
            }
        } */

        return view('admin.settings'/* , compact('vt_types') */);
    }

    public function types(Request $request, $user_id)
    {

        //return $user_id;
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

        //$enabled_types = array();
        $vt_types = array();
        foreach ($types as $type) {
            $enabledArr = array();

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

        $requestedTypes = $request->object;

        $vtiger = new Vtiger();
        $data = $vtiger->listTypes();

        $types = $data->result->types;
        $beDeleted  = [];

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
                $beDeleted = VtigerType::Where($type)->get();
                //$beDeleted = VtigerType::Where('name', $type)/* ->where('user_id', $request->id) */->get();
            }
        }

        return $beDeleted;
    }
}
