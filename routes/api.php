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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/cms/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/app/login', [App\Http\Controllers\AuthController::class, 'loginApp']);

// Posts
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->middleware(['auth:sanctum']);
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'getAll'])->middleware(['auth:sanctum']);
Route::get('/posts/latest', [\App\Http\Controllers\PostController::class, 'getLatest'])->middleware(['auth:sanctum']);
Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'show'])->middleware(['auth:sanctum']);
Route::post('/post/{id}', [App\Http\Controllers\PostController::class, 'update'])->middleware(['auth:sanctum']);
Route::delete('/post/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->middleware(['auth:sanctum']);

// Emballage
Route::get('/cms/emballage', [\App\Http\Controllers\EmballageController::class, 'getSubmitted'])->middleware(['auth:sanctum']);
Route::get('/app/emballage', [\App\Http\Controllers\EmballageController::class, 'userEmballage'])->middleware(['auth:sanctum']);
Route::post('/emballage', [\App\Http\Controllers\EmballageController::class, 'create'])->middleware(['auth:sanctum']);

// Cables
Route::get('/cables/search', [\App\Http\Controllers\CableController::class, 'search']);

// User
Route::get('/users/all', [App\Http\Controllers\UserController::class, 'getAll'])->middleware(['auth:sanctum']);
Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware(['auth:sanctum']);
Route::post('/user/avatar/{id}', [App\Http\Controllers\UserController::class, 'avatar'])->middleware(['auth:sanctum']);
// User CMS
Route::post('/cms/users/all', [App\Http\Controllers\UserController::class, 'getAll'])->middleware(['auth:sanctum']);

// Mail
Route::post('/mail/test', [App\Http\Controllers\MailController::class, 'sendMail']);


// STATS
Route::get('/cms/users/count', [App\Http\Controllers\UserController::class, 'getAllCount'])->middleware(['auth:sanctum']);
Route::get('/cms/emballage/count', [App\Http\Controllers\EmballageController::class, 'getEmballageCount'])->middleware(['auth:sanctum']);

