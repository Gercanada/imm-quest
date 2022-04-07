<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Exception;
use Illuminate\Http\Request;

class FactorController extends Controller
{

    public function getAges()
    {
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $ages = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Age") {
                        array_push(
                            $ages,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
                                'Married' => $item['Married']
                            ]
                        );
                    }
                }
            }

            return response()->json($ages);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function dataFile()
    {
        return json_decode(file_get_contents(storage_path() . "/temp-data.json"), true);
    }
}
