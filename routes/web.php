<?php

use App\Http\Controllers\FactorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
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

/* Route::get('/', function () {
    return view('index');
}); */
// Route::get('/', [QuestionController::class,"index"]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tempdata', [FactorController::class, 'dataFile']);
Route::get('/factors-table', [FactorController::class, 'factorsTable']);

/* Factor 1 */
Route::get('/factor-1/ages', [FactorController::class, 'getAges']);
Route::get('/factor-1/work-experiency', [FactorController::class, 'getExperiency']);
Route::get('/factor-1/education', [FactorController::class, 'getEducation']);
Route::get('/factor-1/language-reading', [FactorController::class, 'getLangReading']);
Route::get('/factor-1/language-listening', [FactorController::class, 'getLangListening']);
Route::get('/factor-1/language-writting', [FactorController::class, 'getLangWritting']);
Route::get('/factor-1/language-speaking', [FactorController::class, 'getLangSpeaking']);
Route::get('/factor-1/second-language', [FactorController::class, 'getSecondLanguage']);

/* factor 2 */

Route::get('/create', function () {
    return view('create');
});

Auth::routes();
