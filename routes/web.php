<?php

use App\Http\Controllers\FactorController;
use App\Http\Controllers\F1HumanCapsController;
use App\Http\Controllers\F2HabilityTransferController;
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
Route::get('/factors-table', [FactorController::class, 'factorsTable']);

/* Factor 1 */
Route::get('/factor-1/ages', [F1HumanCapsController::class, 'getAges']);
Route::get('/factor-1/work-experiency', [F1HumanCapsController::class, 'getExperiency']);
Route::get('/factor-1/education', [F1HumanCapsController::class, 'getEducation']);
Route::get('/factor-1/language-reading', [F1HumanCapsController::class, 'getLangReading']);
Route::get('/factor-1/language-listening', [F1HumanCapsController::class, 'getLangListening']);
Route::get('/factor-1/language-writting', [F1HumanCapsController::class, 'getLangWritting']);
Route::get('/factor-1/language-speaking', [F1HumanCapsController::class, 'getLangSpeaking']);
Route::get('/factor-1/second-language', [F1HumanCapsController::class, 'getSecondLanguage']);

/* factor 2 */
Route::get('/factor-2/{factor}', [F2HabilityTransferController::class, 'getFactorX']);


Route::get('/create', function () {
    return view('create');
});

Auth::routes();
