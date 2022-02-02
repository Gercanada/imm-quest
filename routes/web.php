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
use App\Http\Controllers\CloneDBController;
use App\Http\Controllers\CommboardController;
use App\Http\Controllers\VtigerController;
use App\Http\Controllers\LSurveyController;

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


Route::middleware('auth')->group(/* ['middleware' => ['auth', 'admin']],  */function () {  // user as cp admin
    //vtiger
    Route::get('/vtiger/describe/types/{user_id}', [VtigerController::class, "types"]);
    Route::get('/vtiger/list/{type}/{where}', [VtigerController::class, 'goType']);

    //Route::get('/imm/contacts', [UserController::class, 'listVTUsers']);
    //Route::post('/imm/contacts', [UserController::class, 'importVTUsers']);

    Route::post('/vtiger_config', [VtigerController::class, 'configTypes'])->name('configTypes'); // Config access for users ((not required now))
    Route::get('/user_types_access', [VtigerController::class, 'show']);
    Route::get('/vtiger/describe/{type}', [VtigerController::class, 'getType']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])/* ->middleware(['auth']) */->name('dashboard');
    //case
    Route::get('/cases', [CPCaseController::class, 'index'])/* ->middleware(['auth']) */->name('cases');
    Route::get('/case/{id}', [CPCaseController::class, 'show'])/* ->middleware(['auth']) */->name('show_case');
    Route::get('/details_case/{id}', [CPCaseController::class, 'details'])/* ->middleware(['auth']) */;
    //Commboard
    Route::get('/comments', [CommboardController::class, 'getComments']);
    Route::post('/comments', [CommboardController::class, 'sendComment']);
    Route::get('/commboard', [CommboardController::class, 'index'])->name('commboard');


    //user
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/account', [UserController::class, 'account']);
    Route::post('/account', [UserController::class, 'update']);

    Route::post('/new_password', [UserController::class, 'newPassword']);
    Route::post('/new_username', [UserController::class, 'newUserName']);

    Route::get('/user_themme', [UserController::class, 'getThemme']);
    Route::post('/user_themme', [UserController::class, 'setThemme']);

    //documents
    Route::get('/documents', [DocumentController::class, 'index'])/* ->middleware(['auth']) */->name('documents');
    Route::get('/get_documents', [DocumentController::class, 'getDocuments'])/* ->middleware(['auth']) */;
    //checklists
    Route::get('/checklists', [ChecklistController::class, 'index'])/* ->middleware(['auth']) */->name('checklists');
    Route::get('/checklist/{id}', [ChecklistController::class, 'show'])/* ->middleware(['auth']) */->name('show_checklist');
    Route::get('/checklist/{check_list}/item/{id}', [CLItemController::class, 'dvupload'])/* ->middleware(['auth']) */->name('checklist_item');
    //cl items
    Route::post('/cl-item', [CLItemController::class, 'show'])/* ->middleware(['auth']) */;
    Route::post('/cl-item/upload/file', [CLItemController::class, 'uploadFile'])/* ->middleware(['auth']) */;
    Route::post('/cl-item/send_file', [CLItemController::class, 'sendDocumentToImmcase'])/* ->middleware(['auth']) */;
    Route::post('/cl-item/dropfile', [CLItemController::class, 'deleteDocument'])/* ->middleware(['auth']) */;
    //quotes
    Route::get('/quotes', [QuoteController::class, 'index'])/* ->middleware(['auth']) */->name('quotes');
    Route::get('/quotes/{id}', [QuoteController::class, 'show'])/* ->middleware(['auth']) */->name('showQuote');
    //invoices
    Route::get('/invoices', [InvoiceController::class, 'index'])/* ->middleware(['auth']) */->name('invoices');
    Route::get('/invoices/{id}', [InvoiceController::class, 'show'])/* ->middleware(['auth']) */->name('show_invoice');
    //payments
    Route::get('/payments', [PaymentController::class, 'index'])/* ->middleware(['auth']) */->name('payments');

    Route::get('/documents/{contact}/', [CLItemController::class, 'downloadFile']);


    Route::get('/questionaries', [LSurveyController::class, 'index']);
    Route::post('/questionaries/export_response', [LSurveyController::class, 'exportResponse'])->name('export_response');

    Route::any('{any}', function () {
        abort(404);
    })->where('any', '.*');
});
