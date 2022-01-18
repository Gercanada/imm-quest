<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CloneDBController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::post('/user_params',  [CloneDBController::class, 'testws']);


Route::middleware('imm-header')->group(function(){
    Route::post('/documents', [DocumentController::class , 'checkDocuments']);
    Route::post('/clitem_doc', [DocumentController::class , 'createCLItemDoc']);
    Route::post('/remove_document', [DocumentController::class , 'destroy']);
    Route::post('/single_url', [DocumentController::class , 'singleUrl']);


    Route::post('/getresponse', [DocumentController::class , 'getResponse']);

    Route::post('/create_user', [UserController::class, 'createUser']);

    Route::post('/remove_user', [UserController::class, 'removeUser']);

    Route::post('/clear_trash', [CloneDBController::class, 'clearTrashDB']);
    Route::post('/viger/clonedb', [CloneDBController::class, 'cloneImmcaseContactData']);
    Route::post('/viger/update_contact', [CloneDBController::class, 'updateOnImmcase']);

    Route::post('/viger/find_duplicates', [CloneDBController::class, 'duplicateContacts']);


    Route::get('/migrate', function(){
       \Artisan::call('migrate:fresh');
        return('migrated!');
    });
    Route::get('/optimize', function(){
       \Artisan::call('optimize:clear');
        return('Optimized!');
    });
    Route::get('/keygen', function(){
        \Artisan::call('key:generate');
         return('Key generated!');
     });

     Route::get('/npm_dev', function(){
        shell_exec('npm run dev');
         return('Compiled successfull!');
     });

});


