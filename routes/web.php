<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CPCaseController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CLItemController;
use App\Http\Controllers\GoogleDriveController;

use App\Http\Controllers\ViewController;
use App\Http\Controllers\VtigerController;

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

//Google Drive Routes
Route::get('/login/google', [LoginController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleProviderCallback']);


Route::middleware('auth')->group(function () {
    //user

    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/account', [UserController::class, 'account']);
    Route::post('/account', [UserController::class, 'update']);

    // GDrive
    Route::get('/drive/all', [GoogleDriveController::class, 'getFolders'])->name('google.folders');
    Route::get('/drive/empty', [GoogleDriveController::class, 'isEmpty']);
    Route::post('/drive/upload/', [GoogleDriveController::class, 'upload']);
    Route::post('/drive/delete', [GoogleDriveController::class, 'delete']);

    Route::post('/cl-item', [CLItemController::class, 'show'])->middleware(['auth']);

    // vtiger

    Route::get('/vtiger', [VtigerController::class, 'index']);
    Route::get('/vtiger/{type}', [VtigerController::class, 'getType']);
    Route::post('/vtiger_config', [VtigerController::class, 'configTypes'])->name('configTypes');
});


//Route::get('/checklist:id', [ViewController::class, 'show_checklist'])->middleware(['auth'])->name('show_checklist');
//Route::get('/checklist:id/item/:id', [ViewController::class, 'checklist_item'])->middleware(['auth'])->name('checklist_item');
Route::get('/checklist:id/item-ef/:id', [ViewController::class, 'checklist_item_ef'])->middleware(['auth'])->name('checklist_item_ef');


// Route::get('/quotes:id/pending', [ViewController::class, 'pending_quotes'])->middleware(['auth'])->name('pending_quotes');
Route::get('/quotes:id/accepted', [ViewController::class, 'accepted_quotes'])->middleware(['auth'])->name('accepted_quotes');


Route::get('/documents', [ViewController::class, 'documents'])->middleware(['auth'])->name('documents');
Route::get('/commboard', [ViewController::class, 'commboard'])->middleware(['auth'])->name('commboard');


/* Route::get('/invoices:id', [ViewController::class, 'show_invoice'])->middleware(['auth'])->name('show_invoice'); */






Route::post('/documents', [DocumentController::class, 'store']);


////Functional routes


Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/cases', [CPCaseController::class, 'index'])->middleware(['auth'])->name('cases');
Route::get('/case/{id}', [CPCaseController::class, 'show'])->middleware(['auth'])->name('show_case');


Route::get('/checklists', [ChecklistController::class, 'index'])->middleware(['auth'])->name('checklists');
Route::get('/checklist/{id}', [ChecklistController::class, 'show'])->middleware(['auth'])->name('show_checklist');



Route::get('/checklist/{check_list}/item/{id}', [CLItemController::class, 'dvupload'])->middleware(['auth'])->name('checklist_item');
// /Route::get('/checklist/{check_list}/item/{id}', [CLItemController::class, 'dvupload'])->middleware(['auth'])->name('checklist_item');




Route::get('/quotes', [QuoteController::class, 'index'])->middleware(['auth'])->name('quotes');
Route::get('/quotes/{id}', [QuoteController::class, 'show'])->middleware(['auth'])->name('pending_quotes');

Route::get('/invoices', [InvoiceController::class, 'index'])->middleware(['auth'])->name('invoices');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->middleware(['auth'])->name('show_invoice');


Route::get('/payments', [PaymentController::class, 'index'])->middleware(['auth'])->name('payments');

/*
Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp client
});
Route::group(['middleware' => ['auth', 'permission']], function () {  // user as cp admin
});
 */


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
