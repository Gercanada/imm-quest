<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSituation;
use App\Models\Factor;
use App\Models\Scenario;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class FactorController extends Controller
{
    public function dataFile()
    {
        return json_decode(file_get_contents(storage_path() . "/temp-data.json"), true);
    }

    public function factorsTable($subfactor)
    {
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
        $SubId = 1;
        $critId = 1;
        $subFactId = null;
        foreach ($tabla as $item) {
            foreach ($item as $key => $inner) {
                $cols = array_column($subfactors, "subfactor");
                if ($key === "Sub Facto" &&  !in_array($inner, $cols)) {
                    $SubId = $SubId + 1;
                    $subFactId = $SubId;
                    $factorId = null;
                    if (isset($item['Facto'])) {
                        $factorId = $item['Facto'] == "Facto 1 | Coe Human Capital factos"
                            ? 2 : ($item['Facto'] == "Facto 3 | Skills transferability"
                                ? 3 : ($item['Facto'] == "Facto 4 | Additional Points"
                                    ? 4 : ($item['Facto'] == "Facto 2 | Spouse Attributes" ? 5 : null)));
                    } else {
                        if (isset($item['Sub Facto']) && str_contains($item['Sub Facto'], 'Additional Points')) {
                            $factorId = 4;
                        }
                    }
                    array_push(
                        $subfactors,
                        [
                            "id" => $SubId,
                            "subfactor" => $inner,
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
        // return $subfactors;
        //return [$subfactors, $criteria];
        // return [$subfactors, $criteria];
        return  $criteria;
    }

    public function factors()/* get factors for  create accordions */
    {

        $scenarios = null;
        $factors = Factor::where('factors.title', '!=', 'default')
            ->with('subfactors')
            // ->where('subfactors.subfactor', '!=', 'default')
            ->with('subfactors.criteria')->get();

        if (Auth::user()) {
            $user = Auth::user();
            $scenarios = Scenario::Where('user_id', $user->id)->get();
        }
        return [$factors, $scenarios];
    }


    /**
     * To save an scenario be required auth (Loogin or register redirect)
     */
    public function saveScenario(Request $request)
    {
        try {
            // return $request;

            $user = Auth::user();
            Scenario::create([
                'user_id' => $user->id,
                'name' => $request->scenarioName,
                'is_married' => $request->actualSituation[0] === 'Married' ? true : false,
                'body' => $request->actualSituation[2]
            ]);
            return 200;
        } catch (Exception $e) {
            $this->consoleWrite($e->getMessage());
            $this->consoleWrite($e);
            return response()->json($e);
        }
    }
}