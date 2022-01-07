<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

###################
##   Unauthed    ##
###################

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/cms/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/app/login', [App\Http\Controllers\AuthController::class, 'loginApp']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user(); });

###################
##     Admin     ##
###################
    Route::group(['middleware' => 'check.admin'], function () {
        /* Posts */
        Route::post('/posts', [App\Http\Controllers\PostController::class, 'store']);
        Route::post('/post/{id}', [App\Http\Controllers\PostController::class, 'update']);
        Route::delete('/post/{id}', [App\Http\Controllers\PostController::class, 'destroy']);

        /* Emballage */
        Route::get('/cms/emballage/search', [\App\Http\Controllers\EmballageController::class, 'searchEmballage']);
        Route::get('/cms/emballage/count', [App\Http\Controllers\EmballageController::class, 'getEmballageCount']);
        Route::get('/cms/emballage/{type}', [\App\Http\Controllers\EmballageController::class, 'getEmballageByType']);
        Route::post('/cms/emballage/status/{id}', [\App\Http\Controllers\EmballageController::class, 'setStatus']);

        /* Cables */
        Route::post('/cms/cables/import', [\App\Http\Controllers\CableController::class, 'create']);

        /* User */
        Route::get('/cms/employees', [App\Http\Controllers\UserController::class, 'getEmployees']);
        Route::post('/cms/employee', [App\Http\Controllers\UserController::class, 'create']);
        Route::post('/cms/employee/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
        Route::post('/cms/users/all', [App\Http\Controllers\UserController::class, 'getAll']);
        Route::get('/cms/users/search', [\App\Http\Controllers\UserController::class, 'search']);

        /* Mail */
        Route::post('/mail/test', [App\Http\Controllers\MailController::class, 'sendMail']);

        /* Statistics */
        Route::get('/cms/users/count', [App\Http\Controllers\UserController::class, 'getAllCount'])->middleware(['auth:sanctum']);
    });

###################
##      User     ##
###################
    Route::group(['middleware' => 'auth:sanctum'], function() {
        /* Posts */
        Route::get('/posts', [\App\Http\Controllers\PostController::class, 'getAll']);
        Route::get('/posts/latest', [\App\Http\Controllers\PostController::class, 'getLatest']);
        Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'show']);

        /* Emballage */
        Route::get('/app/emballage', [\App\Http\Controllers\EmballageController::class, 'userEmballage']);
        Route::get('/app/emballage/{id}', [\App\Http\Controllers\EmballageController::class, 'getEmballage']);
        Route::post('/emballage', [\App\Http\Controllers\EmballageController::class, 'create']);

        /* Cables */
        Route::get('/cables/search', [\App\Http\Controllers\CableController::class, 'search']);

        /* User */
        Route::get('/users/all', [App\Http\Controllers\UserController::class, 'getAll']);
        Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'update']);
        Route::post('/user/avatar/{id}', [App\Http\Controllers\UserController::class, 'avatar']);
    });

