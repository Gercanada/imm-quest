<?php

use App\Http\Controllers\VtigerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/vtiger/types/{user_id}', [VtigerController::class, "types"]);
Route::post('/vtiger_config', [VtigerController::class, 'configTypes'])->name('configTypes');
