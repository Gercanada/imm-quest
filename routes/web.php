<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactorController;
use App\Mail\TestingMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/send_mail', function () { //test function only
    try {
        Mail::to('heriberto.h@gercanada.com')->send(new TestingMail());
        return "Sent";
    } catch (Exception $e) {
        return $e->getMessage();
    }
});


Route::middleware('Language')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('set-lang/{lang}', [Controller::class, 'lang']);

    Auth::routes();

    if (env('APP_ENV') === 'local') {
        Route::get('/tempdata', [FactorController::class, 'dataFile']); //returns a json response
        Route::get('/factors-table/{subfactor}', [FactorController::class, 'factorsTable']); //returns ajson response
        Route::get('/factor/{subFactor}', [FactorController::class, 'getFactor']);
        Route::get('/subfactors', [FactorController::class, 'listSubfactors']); //List subfactors for create seeders

        Route::get('/translated', [FactorController::class, 'translatedFactors']); //List subfactors for create seeders
        Route::get('/translated/subfactors', [FactorController::class, 'translatedSubfactors']); //List subfactors for create seeders
    }

    /*data for views*/
    Route::get('/factors', [FactorController::class, 'factors']);

    Route::middleware('auth')->group(function () {

        Route::get('/change-language/{lang}',  [UserController::class, 'changeLang']);
        //user
        Route::get('/profile',  [UserController::class, 'profile'])->name('profile');

        Route::get('/account',  [UserController::class, 'account']);

        Route::post('/account', [UserController::class, 'update']);

        Route::post('/new_password', [UserController::class, 'newPassword']);
        //User themme
        Route::get('/user_themme',  [UserController::class, 'getThemme']);
        Route::post('/user_themme', [UserController::class, 'setThemme']);
        // Route::get('/user_themme', [UserController::class, 'changeThemme']);

        //Scenarios
        Route::post('save-situation', [FactorController::class, 'saveScenario']);
        Route::post('copy', [FactorController::class, 'copyScenario']);
        Route::post('delete/{id}', [FactorController::class, 'deleteScennary']);
        Route::post('print-summary', [FactorController::class, 'printSummary']);
        Route::get('open_pdf/{fileName}', [FactorController::class, 'openPdf']);
        Route::get('delete_temp_file/{fileName}', [FactorController::class, 'deletePdf']);

        Route::any('{any}', function () {
            abort(404);
        })->where('any', '.*');
    });
});
