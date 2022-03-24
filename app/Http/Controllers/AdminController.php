<?php

namespace App\Http\Controllers;

use JBtje\VtigerLaravel\Vtiger;

use Illuminate\Http\Request;
use App\Models\RelationType;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function getTypes()
    {
        $vtiger = new Vtiger();
        $data = $vtiger->listTypes();
        $types = $data->result->types;
        // $types = $types;
        return response()->json($types);

        $current_relations = RelationType::select('id', 'type', 'user_field')->get();

        $data = [];

        foreach ($types as $type) {
            $relation = RelationType::where('type', $type)->first() ?: null;
            $described = $vtiger->describe($type);

            $fields = [];
            foreach ($described->result->fields as $field) {
                if ($relation != null && $relation->user_field === $field->name) {
                    array_push($fields, ['name' => $field->name, 'label' => $field->label, 'selected' => true]);
                } else {
                    array_push($fields, ['name' => $field->name, 'label' => $field->label, 'selected' => false]);
                }
            }
            array_push($data, ['type' => $type, 'fields' => $fields]);
        }
        return response()->json($data);
    }

    public function describeType(Request $request)
    {
        try {
            $vtiger = new Vtiger();
            $relation = RelationType::where('type', $request->type)->first() ?: null;
            $vtTypes = $vtiger->describe($request->type);
            $data = [];
            foreach ($vtTypes->result->fields as $field) {
                if ($relation != null && $relation->user_field === $field->name) {
                    array_push($data, ['name' => $field->name, 'label' => $field->label, 'selected' => true]);
                } else {
                    array_push($data, ['name' => $field->name, 'label' => $field->label, 'selected' => false]);
                }
            }
            return response()->json(['type' => $request->type, 'fields' => $data]);
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['AdminController' => 'describeType']);
        }
    }

    public function saveRelation(Request $request)
    {
        try {
            $relation = RelationType::updateOrCreate(
                ['type' => $request->type],
                ['user_field' => $request->field]
            );
            return $relation;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['AdminController' => 'saveRelation']);
        }
    }
}
