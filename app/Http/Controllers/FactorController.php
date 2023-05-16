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
            // $locale = 'en';
            // return $locale;
            $factors = Factor::where('factors.title', '!=', 'default')
                ->with('subfactors')
                // ->where('subfactors.subfactor', '!=', 'default')
                ->with('subfactors.criteria')->get();

            $response = [];

            if ($locale == 'en') {
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
            $locale = App::getLocale() ? App::getLocale() : 'en';

            $scenarios = Scenario::Where('user_id', 2/* $user->id */)
                ->With(['user' => function ($q) {
                    $q->select(
                        'id',
                        'user_name',
                        'email',
                        'name',
                        'last_name',
                        'avatar'
                    );
                }])
                ->select(
                    'id',
                    'name',
                    'body',
                    'is_married',
                    'is_theactual',
                    'created_at',
                    'updated_at',
                    'user_id',
                )->get();


            $index = 0;
            foreach ($scenarios as $key => $scenario) {
                $obj = [];

                foreach (json_decode($scenario) as $k => $val) {
                    if ($k === 'body') {
                        // $arr = [];
                        // dd($scenario['is_married']);
                        $factors = [];
                        foreach (json_decode($val) as $key => $val) {
                            $fact = Factor::where('id', (int)$val->factor)->select(
                                'id',
                                'title',
                                'titulo',
                                'sub_title',
                                'sub_titulo'
                            )->first();
                            if (!array_key_exists($fact['title'], $factors)) {
                                $factors[$fact['title']] = [];
                            }

                            $selectSub = ['id', /* 'subfactor', 'subfacto', */ 'factor_id'];
                            $locale === 'en' && $selectSub[] = 'subfactor AS subfactor';
                            $locale === 'es' && $selectSub[] = 'subfacto AS subfactor';
                            $subFact = Subfactor::where('id', (int)$val->subfactor)->select($selectSub)->first();
                            if (array_key_exists($fact['title'], $factors) && !array_key_exists($subFact['subfactor'], $factors[$fact['title']])) {
                                $factors[$fact['title']][$subFact['subfactor']] = [];
                            }

                            $selectCrit = ['id'];
                            $scenario['is_married'] &&  $selectCrit[] = 'married AS value';
                            !$scenario['is_married'] &&  $selectCrit[] = 'single AS value';
                            $locale === 'en' && $selectCrit[] = 'criterion AS criterion';
                            $locale === 'es' && $selectCrit[] = 'criterio AS criterion';

                            $crit = Criterion::where('id', (int)$val->criterion)->select($selectCrit)
                                ->where(function ($q) use ($scenario) {
                                })
                                ->first();

                            if (
                                array_key_exists($fact['title'], $factors)
                                && array_key_exists($subFact['subfactor'], $factors[$fact['title']])
                                && !array_key_exists($crit['criterion'], $factors[$fact['title']][$subFact['subfactor']])
                            ) {
                                $factors[$fact['title']][$subFact['subfactor']] = $crit;
                            }
                        }
                        $obj[$k] = $factors; //json_decode($val);
                    } else {
                        $obj[$k] = $val;
                    }
                }
                $scenarios[$index] = $obj;
                $index = $index + 1;
            }


            $theadTr1 = '';
            $theadTr2 = '';
            $thead = '';
            $tbody = '';
            $order = ["user", "name", "is_married", "is_theactual"];

            $theadTr1 .= "<th rowspan='2' colspan='1'>User name</th>" .
                "<th rowspan='2' colspan='1'>Scenario name</th>"
                . "<th rowspan='2' colspan='1'>Married</th>"
                . "<th rowspan='2' colspan='1'>Is actual</th>";

            foreach ($scenarios as $scenario) {
                foreach (array_keys((array)$scenario['body']) as $scKey) {
                    $collspan = 1;
                    foreach (array_keys((array)$scenario['body'][$scKey]) as $inKey) {
                        if (!str_contains($theadTr2, $inKey)) {
                            $collspan += 1;
                            $theadTr2 .= "<th>" . $inKey . "</th>";
                            array_push($order, $inKey);
                        }
                    }
                    if (!str_contains($theadTr1, $scKey)) {
                        $th = "<th rowspan='1' colspan='"
                            . $collspan
                            . "'>"
                            . $scKey
                            . "</th>";
                        //! set string if not included in string
                        $theadTr1 .=  $th;
                    }
                }
            }

            $thead .= "<tr>" . $theadTr1 . "</tr>" . "<tr>" . $theadTr2 . "</tr>";

            foreach ($scenarios as $scenario) {
                $tds = "";
                foreach ($order as $inKey) {
                    if ($inKey === "user") {
                        $tds .=
                            "<td>" .
                            $scenario[$inKey]->name .
                            "  " .
                            $scenario[$inKey]->last_name .
                            "</td>";
                    } else if ($inKey === "name") {
                        $tds .= "<td>" . $scenario[$inKey] . "</td>";
                    } else if (in_array($inKey, ["is_married", "is_theactual"])) {
                        $tds .= "<td>" . $scenario[$inKey] . "</td>";
                    } else if (!in_array($inKey, ["id", "created_at", "updated_at", "body", "user_id"])) {
                        $val = "";
                        foreach (array_values($scenario["body"]) as $factor) {
                            foreach ($factor as $criterion => $criterionData) {
                                if ($criterion === $inKey) {
                                    $val =
                                        "<p><b> Criterio:  </b>" .
                                        $criterionData . $criterion .
                                        "<br><b> Puntos: </b>" .
                                        $criterionData->value .
                                        "</p>";
                                }
                            }
                        }
                        $tds .= "<td>" . $val . "</td>";
                    }
                }
                $tbody .= "<tr>" . $tds . "</tr>";
            }


            $htmlStr =  '<div class="bootstrap-table" style="overflow-x: auto">
            <table
              data-toggle="table"
              data-mobile-responsive="true"
              class="table-striped table table-hover table-bordered"
              data-sort-order="default"
            >
              <thead >' . $thead . '</thead>
              <tbody>' . $tbody . '</tbody>
            </table>
          </div>';

            // dd($htmlStr);


            $fileName = $user->name . '_' . $user->last_name . '_summary' . time() . '.pdf';
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($htmlStr);
            $pdf->setPaper('A4', 'landscape');
            // dd($htmlStr);

            Storage::put(
                'public/pdf/' . $fileName,
                $pdf->stream()
            );
            return response()->json($fileName, 200);            // Storage::put('public/pdf/' . $fileName, $pdf->output());

            return 200;

            $pdfContent = $pdf->output();
            $response = response($pdfContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="documento.pdf"',
            ]);
            return $response;


            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($htmlStr);
            /*   if ($request->orientation) {
                $pdf->setPaper('A4', 'landscape');
            } */
            return $pdf->stream();
            $pdfContent = $pdf->output();

            return response()->json([
                'pdf' => base64_encode($pdfContent)
            ]);




            $data = [
                'fileName' => $fileName,
                'name' => "$user->name $user->last_name",
                'date' => date('Y/m/d'),
                'factors' =>  $htmlStr,
                /*  'scennarios' =>  $scennariosHtml,
                'maritialSituations' => $scennarioMaritialSituationHtml, */
                // 'totals' => $totals
            ];
            $pdf = PDF::loadView('pdfSummary',  $htmlStr)/* ->setPaper('a4', 'landscape') */;
            Storage::put(
                'public/pdf/' . $fileName,
                $pdf->output()
            );
            return response()->json($fileName, 200);            // Storage::put('public/pdf/' . $fileName, $pdf->output());

            // return response()->json($fileName, 200);
        } catch (Exception $e) {
            // $this->consoleWrite()->writeln($e->getMessage());
            return response()->json($e);
        }
    }

    public function oldPprintSummary()
    {
        try {
            $user = Auth::user();
            $locale = App::getLocale() ? App::getLocale() : 'en';

            $factorsHtml = '';
            $scennariosHtml = '';
            $totals = '';
            $scennarioMaritialSituationHtml = '';
            $totalsForScennario = [];

            $fileName = $user->name . '_' . $user->last_name . '_summary.pdf';

            $scennarios = Scenario::Where('user_id', $user->id)->get();
            $factorTitle = 'factors.title';
            $subtitle = 'sub_title';
            $single = "Single";
            $married = "Married";

            if ($locale === 'es') {
                $factorTitle =  'factors.titulo';
                $subtitle    = 'sub_titulo';
                $single      = "Soltero";
                $married     = "Casado";
            }


            $factors = Factor::where($factorTitle, '!=', 'default')
                ->with('subfactors')
                ->with('subfactors.criteria')->get();

            $criteriaRowArr = [];
            foreach ($factors as $factor) {
                $factCols = [];
                $tdSum = '';
                $scennarioSums = [];
                $title = null;
                $column = '';
                $critCols = [];
                $more = [];
                foreach ($scennarios as $scennario) {
                    $scRitVal = [];
                    $toSumSC = [];
                    $toSum = [];
                    $body = json_decode($scennario['body']);

                    if (is_array($body)) {
                        foreach ($body as $item) {
                            $criterion = Criterion::where('id', $item->criterion)
                                ->select('*')
                                ->first();

                            $subfactor = Subfactor::where('id', $item->subfactor)
                                ->select('*')
                                ->first();

                            // !$title && $title = $criterion['criterion'];
                            if ($item->factor === $factor['id']) {
                                $marriedVal = $scennario->is_married
                                    ? $criterion->married :
                                    $criterion->single;
                                if (
                                    $item->subfactor === $subfactor['id']
                                    && $item->criterion === $criterion['id']
                                ) {
                                    array_push($scRitVal, $marriedVal);
                                }
                                /*
                                 return [
                                    'item' => $item,
                                    'subfactor' => $subfactor,
                                    'criterion' =>  $criterion
                                  ];
                                */
                                array_push($toSum,  $marriedVal);
                                array_push($toSumSC,  $marriedVal);
                                $title = $subfactor['subfactor'];
                                if (!in_array($title, $critCols)) {
                                    array_push($critCols, $title);
                                }
                            }
                        }
                    }

                    $tdSum = $tdSum . "<th class='num-val '>" . array_sum($toSum) . "</th>";
                    array_push($scennarioSums, array_sum($toSumSC));
                    $more[$scennario['id']] = $scRitVal;
                }
                $table = '';
                $numRows = count(current($more));

                for (
                    $i = 0;
                    $i < $numRows;
                    $i++
                ) {
                    $table .= "<tr>";
                    foreach ($more as $key => $values) {
                        if (isset($values[$i])) {
                            $table .= "<td  >{$values[$i]}</td>";
                        } else {
                            $table .= "<td class='totals' ></td>";
                        }
                    }
                    $table .= "</tr>";
                }
                if (!in_array($critCols, $factCols)) {
                    array_push($factCols, $critCols);
                }
                // return $factCols;
                $xRow = ''; //'<td style="border:solid red 1pt">';
                foreach ($factCols[0] as $col) {
                    $xRow = $xRow
                        . '<tr>'
                        . "<td>"
                        . $col
                        . '</td>'
                        . '</tr>';
                }

                /*     $aa = "<tr  style='border:solid  aqua 1pt; width: 100%;'>"
                    . "<td>"
                    . "<table style = 'border:solid red 2pt;' >"
                    .  $xRow
                    . '</table>'
                    . '</td>'
                    . "<td  style='border:solid  aqua 1pt; width: 100%;'>"
                    . "<table  style='border:solid  aqua 1pt; width: 100%;'>"
                    . $table
                    . '</table>'
                    . '</td>'
                    . '</tr>'; */



                $totalsForScennario = $scennarioSums;

                $factorsHtml =  $factorsHtml  . "<tr>"
                    . "<th>" .  $factor['title']
                    . ' '
                    . $factor[$subtitle] . "</th>"
                    . $tdSum
                    . "</tr>"
                    . '<tr>'
                    .  $xRow
                    . '</tr>';
            }

            foreach ($totalsForScennario as $scennarioSum) {
                $totals = $totals . "<th class='num-val totals'>" . $scennarioSum . "</th>";
            }
            foreach ($scennarios as $scennario) {
                $married = $scennario['is_married'] == 1 ? $married : $single;
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

            $pdf = PDF::loadView('pdfSummary', $data)/* ->setPaper('a4', 'landscape') */;
            Storage::put(
                'public/pdf/' . $fileName,
                $pdf->output()
            );
            return response()->json($fileName, 200);
        } catch (Exception $e) {
            $this->consoleWrite()->writeln($e->getMessage());
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
            return response()->json("File deleted");
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
