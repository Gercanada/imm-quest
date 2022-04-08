<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\FactorController;

class F1HumanCapsController extends FactorController
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


    public function getExperiency()
    {
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $experiencies = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Canada Experience") {
                        array_push(
                            $experiencies,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
                                'Married' => $item['Married']
                            ]
                        );
                    }
                }
            }
            return response()->json($experiencies);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getEducation()
    {
        try {

            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Education") {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
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
    public function getLangReading()
    {
        try {

            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Language | Reading") {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
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
    public function getLangWritting()
    {
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Language | Writing") {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
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
    public function getLangListening()
    {
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Language | Listening") {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
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
    public function getLangSpeaking()
    {
        try {

            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Language | Speaking") {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
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
    public function getSecondLanguage()
    {
        try {
            $alldata = $this->dataFile();
            $tabla = $alldata['Tabla'];
            $data = [];
            foreach ($tabla as $key => $item) {
                foreach ($item as $key => $inner) {
                    if ($key === "Sub Facto" && $inner === "Second Language") {
                        array_push(
                            $data,
                            [
                                'Criterion' => $item['Criterion'],
                                'Single' => $item['Single'],
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
