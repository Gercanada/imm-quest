<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CloneDBController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CLItemController;
use App\Http\Controllers\LSurveyController;
use App\Http\Controllers\VtigerController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/hash_pass/{pass}', function ($pass) {
    return response()->json(['password' => $pass, "Hashed" => password_hash($pass, PASSWORD_DEFAULT)]);
});