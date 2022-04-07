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
Route::get('/tempdata', [HomeController::class, 'tempData']);

Route::get('/factor-1/ages', [FactorController::class, 'getAges']);

Route::get('/create', function () {
    return view('create');
});

Auth::routes();

/*
Route::get('/questions', [QuestionController::class, "questions"]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
