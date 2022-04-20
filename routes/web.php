<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CPCaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CLItemController;
use App\Http\Controllers\CommboardController;
use App\Http\Controllers\VtigerController;
use App\Http\Controllers\LSurveyController;
use App\Http\Controllers\CloneDBController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\MqttController;

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

Auth::routes();
Route::get('/tempdata', [FactorController::class, 'dataFile']); //returns a json response
Route::get('/factors-table/{subfactor}', [FactorController::class, 'factorsTable']); //returns ajson response
Route::get('/factor/{subFactor}', [FactorController::class, 'getFactor']);
Route::get('/subfactors', [FactorController::class, 'listSubfactors']); //List subfactors for create seeders

/*data for views*/
Route::get('/factors', [FactorController::class, 'factors']);



Route::middleware('auth')->group(function () {
    //dashboard
    Route::get('/',                  [DashboardController::class, 'index'])->name('dashboard');
    //user
    Route::get('/profile',  [UserController::class, 'profile'])->name('profile');
    Route::get('/account',  [UserController::class, 'account']);
    Route::post('/account', [UserController::class, 'update']);

    Route::post('/new_password', [UserController::class, 'newPassword']);
    Route::post('/new_username', [UserController::class, 'newUserName']);

    //User themme
    Route::get('/user_themme',  [UserController::class, 'getThemme']);
    Route::post('/user_themme', [UserController::class, 'setThemme']);









    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});