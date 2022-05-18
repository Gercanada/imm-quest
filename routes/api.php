<?php

use App\Http\Controllers\FactorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTokenController;

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


/* Route::get('/hash_pass/{pass}', function ($pass) {
    return response()->json(['password' => $pass, "Hashed" => password_hash($pass, PASSWORD_DEFAULT)]);
}); */

Route::post('sanctum/token', UserTokenController::class);

Route::get('/factors', [FactorController::class, 'factors']);                             ` ///Devuelve factores y escenarios de usuario autenticado

Route::middleware(['auth:sanctum'])->group(function () {
    //user
    Route::get('/account',  [UserController::class, 'account']);                          ` ///Obtener usuario
    Route::post('/account', [UserController::class, 'update']);                           ` ///Actualizar datos de usuario
    Route::post('/new_password', [UserController::class, 'newPassword']);                 ` ///Cambiar contraseña
    //User themme
    Route::get('/user_themme',  [UserController::class, 'getThemme']);                    ` ///Obtener tema del usuario (deprecate)
    Route::post('/user_themme', [UserController::class, 'setThemme']);                    ` ///Actualizar tema (oscuro| claro)
    //Scenarios
    Route::post('save-situation', [FactorController::class, 'saveScenario']);             ` ///Guardar cambios en escenario
    Route::post('copy', [FactorController::class, 'copyScenario']);                       ` ///Copiar escenario
    Route::post('delete/{id}', [FactorController::class, 'deleteScennary']);              ` ///Eliminar escenario
    Route::post('print-summary', [FactorController::class, 'printSummary']);              ` ///Generar pdf
    Route::get('open_pdf/{fileName}', [FactorController::class, 'openPdf']);              ` ///Abrir pdf generado
    Route::get('delete_temp_file/{fileName}', [FactorController::class, 'deletePdf']);    ` ///Eliminar el pdf

    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
