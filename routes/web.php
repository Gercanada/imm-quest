<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;

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






Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/account', [UserController::class, 'index']);


Route::get('/account', function () {
    return view('users.index');
})->name('account');

Route::put('/account', [UserController::class, 'update']);

/* Route::get('/', function () {
        return view('content.content');
    });
 */
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
Route::post('/documents', [DocumentController::class, 'store']);


Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp client
});
Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp admin
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
