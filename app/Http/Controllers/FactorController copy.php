<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreSituation;

use App\Models\Criterion;
use App\Models\Factor;
use App\Models\Scenario;
use App\Models\Subfactor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;


use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;

//TODO Checar error 403 en produccion

class FactorController extends Controller
{
    public function dataFile()
    {
        return json_decode(file_get_contents(storage_path() . "/temp-data.json"), true);
    }
    public function translatedFile()
    {
        return json_decode(file_get_contents(storage_path() . "/translations.json"), true);
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



    public function translatedFactors()
    {
        $data =   $this->translatedFile();
        // return $data;
        $factArr = [];
        $en = $data['en'];
        $es = $data['es'];

        $index = 1;
        $factEn = [];
        $factEs = [];

        foreach ($en as $key => $item) {
            $addFact = [
                'title' => substr($item['Factor'], 0, 8),
                'sub_title' => substr($item['Factor'], 8),
                // 'id' => $index
            ];
            if (!in_array($addFact, $factEn)) {
                array_push($factEn, $addFact);
            }
            $index = $index + 1;
        }
        array_push($factArr, ['en' => $factEn]);


        foreach ($es as $key => $item) {
            $addFact = [
                'titulo' => substr($item['Factor'], 0, 8),
                'sub_titulo' => substr($item['Factor'], 8),
            ];
            if (!in_array($addFact, $factEs,)) {
                array_push($factEs, $addFact);
            }
        }
        array_push($factArr, ['es' => $factEs]);
        //EN
        $subfactorsEn = [];
        foreach ($en as $item) {
            $factor =
                ($item['Factor'] == 'Factor 1 - Core Human Capital factors' ? 1
                    : ($item['Factor'] == "Factor 2 - Spouse Attributes" ? 2
                        : ($item['Factor'] == "Factor 3 - Skills transferability" ? 3
                            : ($item['Factor'] == "Factor 4 - Additional Points" ? 4 : null))));
            if (isset($item["Sub Factor"])) {
                $addSub = ['factor_id' => $factor, 'subfactor' => $item['Sub Factor']];
                if (!in_array($addSub, $subfactorsEn,)) {
                    array_push($subfactorsEn, $addSub);
                }
            }
        }
        $subfactorsEs = [];
        foreach ($es as $item) {
            $factor =
                ($item['Factor'] == "Factor 1 | Capital Humano" ? 1
                    : ($item['Factor'] == "Factor 2 | Capital Humano de la Pareja" ? 2
                        : ($item['Factor'] == "Factor 3 | Transferencia de Habilidades" ? 3
                            : ($item['Factor'] == "Factor 4 | Puntos Adicionales" ? 4 : null))));
            if (isset($item["Sub Facto"])) {
                $addSub = ['factor_id' => $factor, 'subfacto' => $item['Sub Facto']];
                if (!in_array($addSub, $subfactorsEs,)) {
                    array_push($subfactorsEs, $addSub);
                }
            }
        }

        $subfArr = [];
        foreach ($subfactorsEn as $o) {
            array_push($subfArr, $o);
        }


        $i = 0;
        $e = 2;
        foreach ($subfactorsEs as $key => $it) {
            $subfArr[$i]['subfacto'] = $it['subfacto'];
            $subfArr[$i]['id'] = $e;
            $i++;
            $e++;
        }
        //  return $subfArr;
        //Subfactors

        //////CRITERIONS
        $criterionsEn = [];
        //Criterion
        // return $en;

        foreach ($en as $item) {
            foreach ($subfArr as $sub) {
                if ($sub['subfactor'] === $item['Sub Factor']) {
                    array_push(
                        $criterionsEn,
                        [
                            'subfactor_id' => $sub['id'],
                            'criterion' => $item['Criterion'],
                            'Single' => $item['Single'],
                            'Married' => $item['Married'],

                        ]
                    );
                }
            }
        }


        $a = 0;
        $b = 2;
        foreach ($es as $obj) {
            foreach ($criterionsEn as $crit) {
                $criterionsEn[$a]['Criterio'] = $obj['Criterion'];
                $criterionsEn[$a]['id'] = $b;
            }
            $a++;
            $b++;
        }




        return   $criterionsEn;
        return ['factors' => $factArr];
    }

    public function translatedSubfactors()
    {
        $data =   $this->translatedFile();

        return $data;
    }

    //////////////////
    public function factors(Request $request)/* get factors for  create accordions */
    {
        try {
            $scenarios = null;
            $locale = App::getLocale() ? App::getLocale() : 'en';

            $factors = Factor::where('factors.title', '!=', 'default')
                ->with('subfactors')
                // ->where('subfactors.subfactor', '!=', 'default')
                ->with('subfactors.criteria')->get();

            $response = [];
            if ($locale == 'es') {
                foreach ($factors as $factor) {
                    $subs = [];
                    foreach ($factor['subfactors'] as $sub) {
                        $criteria = [];
                        foreach ($sub['criteria'] as $crit) {
                            array_push($criteria, [
                                'id' => $crit->id,
                                'criterion' => $crit['criterio'],
                                'married' => $crit['married'],
                                'single' => $crit['single']
                            ]);
                        }
                        array_push($subs, [
                            'id' => $sub->id,
                            'subfactor' => $sub['subfacto'],
                            'factor_id' => $sub['factor_id'],
                            'criteria' => $criteria
                        ]);
                    }

                    array_push($response, [
                        'id' => $factor['id'],
                        'title' => $factor['titulo'],
                        'sub_title' => $factor['sub_titulo'],
                        'subfactors' => $subs
                    ]);
                }
            } else {
                // if ($locale == 'en')
                foreach ($factors as $factor) {
                    $subs = [];
                    foreach ($factor['subfactors'] as $sub) {
                        $criteria = [];
                        foreach ($sub['criteria'] as $crit) {
                            array_push($criteria, [
                                'id' => $crit->id,
                                'criterion' => $crit['criterion'],
                                'married' => $crit['married'],
                                'single' => $crit['single']
                            ]);
                        }
                        array_push($subs, [
                            'id' => $sub->id,
                            'subfactor' => $sub['subfactor'],
                            'factor_id' => $sub['factor_id'],
                            'criteria' => $criteria
                        ]);
                    }
                    array_push($response, [
                        'id' => $factor['id'],
                        'title' => $factor['title'],
                        'sub_title' => $factor['sub_title'],
                        'subfactors' => $subs
                    ]);
                }
            }

            /*    $factors = Factor::where('factors.title', '!=', 'default')
                ->with('subfactors')
                // ->where('subfactors.subfactor', '!=', 'default')
                ->with('subfactors.criteria')->get(); */

            if (Auth::user()) {
                $user = Auth::user();
                $scenarios = Scenario::Where('user_id', $user->id)->get();
            }

            return [$response, $scenarios,  $locale];
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
                        'body' => $isActual == true
                            ? json_encode($request->actualSituation[2])
                            : json_encode($request->actualSituation[1]),
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
            $locale = App::getLocale()
                ? App::getLocale()
                : 'en';

            $scennarios = Scenario::Where('user_id', $user->id)->get();
            $fileName = $user->name . '_' . $user->last_name . '_summary.pdf';

            $factorsHtml = '';
            $scennariosHtml = '';
            $totals = '';
            $scennarioMaritialSituationHtml = '';
            $totalsForScennario = [];

            $factorTitle = 'factors.title';
            $subtitle = 'sub_title';
            $single = "Single";
            $married = "Married";

            if ($locale === 'es') {
                $factorTitle =  'factors.titulo';
                $subtitle = 'sub_titulo';
                $single = "Soltero";
                $married = "Casado";
            }

            $factors = Factor::where($factorTitle, '!=', 'default')
                ->with('subfactors')
                ->with('subfactors.criteria')
                ->get();

            foreach ($factors as $factor) {
                // $tdSubFacts = '';
                $tdSum = ''; //html table
                $scennarioSums = []; //values to sum
                foreach ($scennarios as $scennario) {
                    $toSum = [];
                    $toSumSC = [];
                    $body = json_decode($scennario['body']);
                    // $factArr = [];
                    if (is_array($body)) {
                        foreach ($body as $item) {
                            $body = json_decode($scennario['body']);
                            if (is_array($body)) {
                                foreach ($body as $item) {
                                    $criterion = Criterion::where('id', $item->criterion)
                                        ->select($locale === 'es'
                                            ? 'criterio as criterion'
                                            : 'criterion')->first();
                                    $subfactor = Subfactor::where('id', $item->subfactor)
                                        ->select($locale === 'es'
                                            ? 'subfacto as subfactor'
                                            : 'subfactor')->first();

                                    if ($item->factor === $factor['id']) {
                                        /*   $tdSubFacts
                                            = $tdSubFacts . "<tr>"
                                            . "<td class=''>" . $subfactor['subfactor'] . "</td>"
                                            . "<td class=''>" . $criterion['criterion'] .  "</td>"
                                            . "<td class='num-val'>" . $item->value . "</td>"
                                            . "</tr>"; */
                                    }
                                }
                            }

                            if ($item->factor === $factor['id']) {
                                array_push($toSum, $item->value);
                                array_push($toSumSC, $item->value);
                            }
                        }
                    }
                    $tdSum = $tdSum . "<th  class='num-val totals'>" . array_sum($toSum) . "</th>";
                    array_push($scennarioSums, array_sum($toSumSC));
                }
                $totalsForScennario = $scennarioSums;
                //?subfactors table
                $factorsHtml =  $factorsHtml
                    . "<tr>"
                    . "<th class=''>" .  $factor['title'] . ' ' . $factor[$subtitle] . "</th>"
                    . $tdSum
                    // . $tdSubFacts
                    . "</tr>";
            }
            foreach ($totalsForScennario as $scennarioSum) {
                $totals = $totals . "<th class='num-val totals'>" . $scennarioSum . "</th>";
            }
            foreach ($scennarios as $scennario) {
                $married = $scennario['is_married'] == 1 ? $married : $single;
                $scennariosHtml =  $scennariosHtml  . "<th>" .  $scennario['name'] . "</th>";
                $scennarioMaritialSituationHtml =  $scennarioMaritialSituationHtml
                    . "<th>" . $married . "</th>";
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
