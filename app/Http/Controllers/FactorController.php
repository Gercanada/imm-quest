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
    public function factorsTable()
    {
        return  $this->dataFile()['Tabla'];
    }
}
