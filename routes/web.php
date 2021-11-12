<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ViewController;

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

Route::get('/dashboard', [ViewController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/cases', [ViewController::class, 'cases'])->middleware(['auth'])->name('cases');

Route::get('/case:id', [ViewController::class, 'show_case'])->middleware(['auth'])->name('show_case');
Route::get('/checklist:id', [ViewController::class, 'show_checklist'])->middleware(['auth'])->name('show_checklist');


Route::get('/checklists', [ViewController::class, 'checklists'])->middleware(['auth'])->name('checklists');
Route::get('/quotes', [ViewController::class, 'quotes'])->middleware(['auth'])->name('quotes');
Route::get('/documents', [ViewController::class, 'documents'])->middleware(['auth'])->name('documents');
Route::get('/commboard', [ViewController::class, 'commboard'])->middleware(['auth'])->name('commboard');
Route::get('/invoices', [ViewController::class, 'invoices'])->middleware(['auth'])->name('invoices');
Route::get('/payments', [ViewController::class, 'payments'])->middleware(['auth'])->name('payments');




/* Route::get('/account', [UserController::class, 'index']);
Route::get('/account', function () {
    return view('users.index');
})->name('account');
 */
Route::put('/account', [UserController::class, 'update']);

/* Route::get('/', function () {
        return view('content.content');
    });
 */
/* Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
*/
Route::post('/documents', [DocumentController::class, 'store']);


Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp client
});
Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp admin
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
