<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CloneDBController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CLItemController;
use App\Http\Controllers\LSurveyController;

use Illuminate\Http\Request;

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
/* Route::get('/env/{var}', function($var){
    return response()->json([$var=>env($var)]);
  });
 */

//Route::get('/users', [UserController::class, 'users']);

Route::get('/hash_pass/{pass}', function ($pass) {
    return password_hash($pass, PASSWORD_DEFAULT);
});

Route::post('/return_route', function (Request $request) {
    return response()->json(['url' => $request->url]);
});

Route::middleware('imm-header')->group(function () {
    //Files
    Route::post('/documents',                      [DocumentController::class, 'checkDocuments']);
    Route::post('/remove_document',                [DocumentController::class, 'destroy']);
    Route::post('/single_url',                     [DocumentController::class, 'singleUrl']);
    //DB copy
    Route::post('/viger/clonedb',                  [CloneDBController::class, 'cloneImmcaseContactData']);
    Route::post('/viger/update_contact',           [CloneDBController::class, 'updateOnImmcase']);
    Route::post('/clear_trash',                    [CloneDBController::class, 'clearTrashDB']);
    Route::post('/update_checklist',               [CloneDBController::class, 'updateChecklistFromImmcase']);
    Route::post('/update_clitem',                  [CloneDBController::class, 'updateCLItemFromImmcase']);
    //Lime survey
    Route::post('/questionaries/guest',            [LSurveyController::class, 'guestToSurvey']); //tri not middleware
    Route::post('/questionaries/export_response',  [LSurveyController::class, 'exportResponse']); //Test as service
    //CLItem
    Route::post('/cl-item/send_file',              [CLItemController::class, 'sendDocumentToImmcase']); //Only catch errs
    Route::post('/cl-item/upload',              [CLItemController::class, 'uploadFile']); //Only catch errs

    Route::post('/create_user',                    [UserController::class, 'createUser']);

    //call dev commands
    Route::get('/migrate', function () {
        \Artisan::call('migrate:fresh');
        return ('migrated!');
    });
    Route::get('/optimize', function () {
        \Artisan::call('optimize:clear');
        return ('Optimized!');
    });
    Route::get('/clear', function () {
        \Artisan::call('cache:clear');
        return ('Cleared!');
    });
    Route::get('/cache', function () {
        \Artisan::call('config:cache');
        return ('Cleared cache! ');
    });
    Route::get('/keygen', function () {
        \Artisan::call('key:generate');
        return ('Key generated!');
    });

    Route::get('/npm_dev', function () {
        shell_exec('npm run dev');
        return ('Compiled successfull!');
    });
});
