<?php

use App\Http\Controllers\FactorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tempdata', [FactorController::class, 'dataFile']);
Route::get('/factors-table/{subfactor}', [FactorController::class, 'factorsTable']);

/* factor 2 */
Route::get('/factor/{subFactor}', [FactorController::class, 'getFactor']);

Route::get('/subfactors', [FactorController::class, 'listSubfactors']); //List subfactors for create seeders

Route::get('/factors', [FactorController::class, 'factors']);


Auth::routes();