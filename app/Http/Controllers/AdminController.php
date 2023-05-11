<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Factor;
use App\Models\Scenario;
use App\Models\Subfactor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $locale = App::getLocale()
                ? App::getLocale()
                : 'en';
            $scenarios = Scenario::With(['user' => function ($q) {
                $q->select(
                    'id',
                    'user_name',
                    'email',
                    'name',
                    'last_name',
                    'avatar'
                );
            }])->select(
                'id',
                'name',
                'body',
                'is_married',
                'is_theactual',
                'created_at',
                'updated_at',
                'user_id',
            )->get();

            // return $scenarios;



            $index = 0;
            foreach ($scenarios as $key => $scenario) {
                $obj = [];

                foreach (json_decode($scenario) as $k => $val) {
                    if ($k === 'body') {
                        $arr = [];
                        // dd($scenario['is_married']);

                        $factors = [];
                        foreach (json_decode($val) as $key => $val) {
                            $fact = Factor::where('id', (int)$val->factor)->select('id', 'title', 'titulo', 'sub_title', 'sub_titulo')->first();
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


                            // if (!in_array($crit->criterion, $factors[$fact->subfactor][$subFact->subfactor])) $factors[$fact->criterion][] = $crit->criterion;



                            /*    isset($val->factor) && $arr['factor'] = $fact;
                            isset($val->subfactor) && $arr['subfactor'] = $subFact;


                            isset($val->criterion) && $arr['criterion'] = $crit;
                            isset($val->value) && $arr['value'] = $val->value; */
                        }
                        $obj[$k] = $factors; //json_decode($val);
                    } else {
                        $obj[$k] = $val;
                    }
                }
                /*  if ($scenario->body) {
                    $scenario->body = json_decode($scenario->body);
                } */
                $scenarios[$index] = $obj;
                $index = $index + 1;
            }

            return response()->json($scenarios, 200);
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'method' => __CLASS__ . ' -> ' . __FUNCTION__,
                    'line' => $e->getLine()
                ],
                500
            );
        }
    }


    public function loadView()
    {
        return view('admin-table');
    }
}
