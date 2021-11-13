<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CPCaseController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PaymentController;
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
    /*   Route::get('/', function () {
        return view('welcome');
    }); */
});

Route::get('/case:id', [ViewController::class, 'show_case'])->middleware(['auth'])->name('show_case');
Route::get('/checklist:id', [ViewController::class, 'show_checklist'])->middleware(['auth'])->name('show_checklist');
Route::get('/checklist:id/item/:id', [ViewController::class, 'checklist_item'])->middleware(['auth'])->name('checklist_item');
Route::get('/checklist:id/item-ef/:id', [ViewController::class, 'checklist_item_ef'])->middleware(['auth'])->name('checklist_item_ef');


Route::get('/quotes:id/pending', [ViewController::class, 'pending_quotes'])->middleware(['auth'])->name('pending_quotes');
Route::get('/quotes:id/accepted', [ViewController::class, 'accepted_quotes'])->middleware(['auth'])->name('accepted_quotes');


Route::get('/documents', [ViewController::class, 'documents'])->middleware(['auth'])->name('documents');
Route::get('/commboard', [ViewController::class, 'commboard'])->middleware(['auth'])->name('commboard');


Route::get('/invoices:id', [ViewController::class, 'show_invoice'])->middleware(['auth'])->name('show_invoice');




Route::put('/account', [UserController::class, 'update']);

Route::post('/documents', [DocumentController::class, 'store']);


////Functional routes


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cases', [CPCaseController::class, 'index'])->middleware(['auth'])->name('cases');
Route::get('/checklists', [ChecklistController::class, 'index'])->middleware(['auth'])->name('checklists');
Route::get('/quotes', [QuoteController::class, 'index'])->middleware(['auth'])->name('quotes');
Route::get('/invoices', [InvoiceController::class, 'index'])->middleware(['auth'])->name('invoices');
Route::get('/payments', [PaymentController::class, 'index'])->middleware(['auth'])->name('payments');

/*
Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp client
});
Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp admin
});
 */


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
