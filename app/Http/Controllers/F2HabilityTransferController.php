<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class F2HabilityTransferController extends FactorController
{
    public function getFactorX($factor)
    {
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === $factor) {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => array_key_exists('single', $item) ? $item['Single'] : null,
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
}