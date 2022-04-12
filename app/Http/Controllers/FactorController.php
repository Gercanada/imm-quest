<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Exception;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    public function dataFile()
    {
        return json_decode(file_get_contents(storage_path() . "/temp-data.json"), true);
    }

    public function factorsTable($subfactor)
    {
        // return $subfactor;
        if ($subfactor === 'all') {
            return  $this->dataFile()['Tabla'];
        } else {
            $tabla = $this->dataFile()['Tabla'];
            $data = [];
            foreach ($tabla as $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === $subfactor) {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => array_key_exists('Single', $item) ? $item['Single'] : null,
                                'Married' => $item['Married'],
                                'factor_id' => $item['Married']
                            ]
                        );
                    }
                }
            }
            return $data;
        }
    }



    public function getFactor($subFactor)
    {
        //TODO Try to use seeder of data sheet
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === $subFactor) {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => array_key_exists('Single', $item) ? $item['Single'] : null,
                                'Married' => $item['Married']
                            ]
                        );
                    }
                }
            }
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function listSubfactors()
    {
        $tabla = $this->dataFile()['Tabla'];
        $subfactors = [];
        $criteria = [];
        $SubId = 0;
        $critId = 0;
        $subFactId = null;
        foreach ($tabla as $item) {
            if (isset($item['Facto'])) {
                foreach ($item as $key => $inner) {
                    $cols = array_column($subfactors, "subfactor");
                    if ($key === "Sub Facto" &&  !in_array($inner, $cols)) {
                        $SubId = $SubId + 1;
                        $subFactId = $SubId;

                        $factorId = $item['Facto'] == "Facto 1 | Coe Human Capital factos"
                            ? 1 : ($item['Facto'] == "Facto 3 | Skills transferability"
                                ? 2 : ($item['Facto'] == "Facto 4 | Additional Points"
                                    ? 3 : ($item['Facto'] == "Facto 2 | Spouse Attributes" ? 4 : null)));

                        array_push(
                            $subfactors,
                            [
                                "id" => $SubId,
                                "subfactor" => $inner,
                                // "facto" => $item['Facto'],
                                'factor_id' =>  $factorId
                            ]
                        );
                    }

                    $critCols = array_column($criteria, "criterion");
                    /* agregar el valor de una columna exista solo una vez en un array*/
                    if ($key === "Criterion" &&  !in_array($inner, $critCols)) {
                        $critId = $critId + 1;
                        array_push($criteria, [
                            "id" => $critId,
                            'criterion' => $item['Criterion'],
                            'single' => isset($item['Single']) ? (float)$item['Single'] : null,
                            'married' => (float)($item['Married']),
                            'subfactor_id' => $subFactId,
                        ]);
                    }
                }
            }
        }
        return $subfactors;
        return [$subfactors, $criteria];
        // return [$subfactors, $criteria];
        return  $criteria;
    }
}