<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\VtigerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/documents', [DocumentController::class , 'checkDocuments']);
Route::post('/getresponse', [DocumentController::class , 'getResponse']);

Route::post('/create_user', [UserController::class, 'createUser']);

Route::post('/remove_user', [UserController::class, 'removeUser']);
