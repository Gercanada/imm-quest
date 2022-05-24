<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreSituation;
use App\Models\Factor;
use App\Models\Scenario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;


use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;

//TODO Checar error 403 en produccion

class FactorController extends Controller
{

    public function changeLang($langcode)
    {
        App::setLocale($langcode);
        session()->put("lang_code", $langcode);
        return redirect()->back();
    }


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
        return  $criteria;
    }

    public function factors(Request $request)/* get factors for  create accordions */
    {
        try {
            $scenarios = null;
            $selectQuery = null;
            $locale = App::getLocale();

            if (App::getLocale() == 'en') {
                $factors = Factor::where('factors.title', '!=', 'default')
                    ->select('title', 'sub_title', 'id')
                    ->with(['subfactors' => function ($query) {
                        $query->select('id', 'subfactor', 'factor_id');
                    }])
                    ->with(['subfactors.criteria' => function ($query) {
                        $query->select('id', 'criterion', 'single', 'married', 'subfactor_id');
                    }])
                    // ->select('subfactor', 'factor_id', 'subfactors.criteria')
                    ->get();
            }



            if (App::getLocale() == 'es') {
                $factors = Factor::where('factors.title', '!=', 'default')
                    ->select('titulo as title', 'sub_titulo as sub_title', 'id')
                    ->with(['subfactors' => function ($query) {
                        $query->select('id', 'subfactor_es as subfactor', 'factor_id');
                    }])
                    ->with(['subfactors.criteria' => function ($query) {
                        $query->select('id', 'criterio as criterion', 'single', 'married', 'subfactor_id');
                    }])
                    // ->select('subfactor', 'factor_id', 'subfactors.criteria')
                    ->get();
            }


            $factors = Factor::where('factors.title', '!=', 'default')
                ->with('subfactors')
                // ->where('subfactors.subfactor', '!=', 'default')
                ->with('subfactors.criteria')->get();

            if (Auth::user()) {
                $user = Auth::user();
                $scenarios = Scenario::Where('user_id', $user->id)->get();
            }
            return [$factors, $scenarios,  App::getLocale()];
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    /**
     * To save an scenario be required auth (Loogin or register redirect)
     */
    public function saveScenario(Request $request)
    {
        try {
            $user = Auth::user();
            $currentScennarios = $request->actualSituation[1];
            $actualSituation = null;
            $scennario = null;

            // return $request;
            // Save changes on scennarios copies
            if ($request->scennarioId) {
                $scennario =  Scenario::Where('id', $request->scennarioId)->first();
                $scennario->is_married = $request->maritialStatus === 'Married' ? true : false;
                $scennario->body = json_encode($request->actualSituation[1]);
                $scennario->save();
            } else {
                if (count($currentScennarios) > 0) {
                    foreach ($currentScennarios as $current) {
                        $actual = false;
                        if (isset($current['is_theactual'])) {
                            $actual =  $current['is_theactual'] == true ? true : false;
                        }
                        if ($actual === true) {
                            $actualSituation = $current;
                            break;
                        }
                    }
                    $scenario =  Scenario::updateOrCreate(
                        [
                            'id' => $actualSituation['id'],
                        ],
                        [
                            'user_id' => $user->id,
                            'name' => $request->scenarioName,
                            'is_married' => $request->maritialStatus == 'Married' ? true : false,
                            'body' => json_encode($request->actualSituation[2]),
                        ]
                    );
                } else {
                    $scenario =  Scenario::Create(
                        [
                            'user_id' => $user->id,
                            'name' => $request->scenarioName,
                            'is_married' => $request->maritialStatus === 'Married' ? true : false,
                            'body' => json_encode($request->actualSituation[2]),
                        ]
                    );
                }
            }
            return response()->json($scenario);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function copyScenario(Request $request)
    {
        try {
            $user = Auth::user();
            $maritial = false;
            if ($request->maritialStatus) {
                $maritial = $request->maritialStatus === 'Married' ? true : false;
            }
            if ($request->actualSituation[0]) {
                $maritial = $request->actualSituation[0] === 'Married' ? true : false;
            }
            $isActual = false;
            $isActual = $request->isActual;

            $scennarios = Scenario::where('user_id', $user->id)->get();
            if (count($scennarios) >= 3) {
                return response()->json('has_max');
            } else {
                $scenario =  Scenario::create(
                    [
                        'user_id' => $user->id,
                        'is_theactual' => false,
                        'name' => $request->scenarioName,
                        'is_married' => $maritial,
                        'body' => $isActual == true ? json_encode($request->actualSituation[2]) : json_encode($request->actualSituation[1]),
                    ]
                );
            }
            return response()->json($scenario);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function deleteScennary($id)
    {
        try {
            Scenario::where('id', $id)->delete();
            return response()->json(200);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * It method be called by an user to generate a temporal pdf file that be downloaded next of be generated
     * usung openPdf, Then of the file is opened at new window be deleted from storage
     */
    public function printSummary()
    {
        try {
            $user = Auth::user();
            $factorsHtml = '';
            $scennariosHtml = '';
            $totals = '';
            $scennarioMaritialSituationHtml = '';
            $totalsForScennario = [];

            $fileName = $user->name . '_' . $user->last_name . '_summary.pdf';

            $scennarios = Scenario::Where('user_id', $user->id)->get();

            $factors = Factor::where('factors.title', '!=', 'default')
                ->with('subfactors')
                ->with('subfactors.criteria')->get();

            foreach ($factors as $factor) {
                $tdSum = '';
                $same = $factor->id;
                $scennarioSums = [];
                foreach ($scennarios as $scennario) {
                    $toSum = [];
                    $toSumSC = [];
                    $body = json_decode($scennario['body']);
                    if (is_array($body)) {
                        foreach ($body as $item) {
                            if ($same ==  $factor['id']) {
                                if ($item->factor === $factor['id']) {
                                    array_push($toSum, $item->value);
                                }
                                array_push($toSumSC, $item->value);
                            }
                        }
                    }
                    $tdSum = $tdSum . "<td class='num-val '>" . array_sum($toSum) . "</td>";
                    array_push($scennarioSums, array_sum($toSumSC));
                }
                $totalsForScennario = $scennarioSums;

                $factorsHtml =  $factorsHtml  . "<tr>"
                    . "<td>" .  $factor['title'] . ' ' . $factor['sub_title'] . "</td>"
                    . $tdSum
                    . "</tr>";
            }

            foreach ($totalsForScennario as $scennarioSum) {
                $totals = $totals . "<th class='num-val totals'>" . $scennarioSum . "</th>";
            }
            foreach ($scennarios as $scennario) {
                $married = $scennario['is_married'] == 1 ? 'Casado' : 'Soltero';
                $scennariosHtml =  $scennariosHtml  . "<th>" .  $scennario['name'] . "</th>";
                $scennarioMaritialSituationHtml =  $scennarioMaritialSituationHtml  . "<th>" . $married . "</th>";
            }

            /**
             * Data for fill file
             */
            $data = [
                'fileName' => $fileName,
                'name' => "$user->name $user->last_name",
                'date' => date('Y/m/d'),
                'factors' =>  $factorsHtml,
                'scennarios' =>  $scennariosHtml,
                'maritialSituations' => $scennarioMaritialSituationHtml,
                'totals' => $totals
            ];
            $pdf = PDF::loadView('pdfSummary', $data); //->setPaper('a4', 'landscape');
            Storage::put('public/pdf/' . $fileName, $pdf->output());
            return response()->json($fileName, 200);
        } catch (Exception $e) {
            // $this->consoleWrite()->writeln($e->getMessage());
            return response()->json($e);
        }
    }

    /**
     * It be open pdf generated in new view as file
     */
    public function openPdf($fileName)
    {
        try {
            $filePath = "app/public/pdf/" . $fileName;
            return response()->file(storage_path($filePath));
        } catch (Exception $e) {
            return response()->json("$fileName not found :(");
        }
    }

    /**
     * The pdf file be deleted then of open
     */
    public function deletePdf($fileName)
    {
        try {
            $filePath = "pdf/" . $fileName;
            Storage::disk('public')->delete($filePath);
            return  response()->json("File deleted");
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
