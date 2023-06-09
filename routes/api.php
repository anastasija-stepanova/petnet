<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/user', [Controllers\MyUserController::class, 'create']);

Route::middleware(\App\Http\Middleware\Auth::class)->group(function () {
    Route::get('/user/{id}', [Controllers\MyUserController::class, 'get', 'id']);

    Route::delete('/user/{id}', [Controllers\MyUserController::class, 'delete', 'id']);

    Route::post('/user/{id}', [Controllers\MyUserController::class, 'update', 'id']);

    Route::post('/pet', [Controllers\PetController::class, 'create']);

    Route::get('/pet/{id}', [Controllers\PetController::class, 'get', 'id']);

    Route::delete('/pet/{id}', [Controllers\PetController::class, 'delete', 'id']);

    Route::post('/pet/{id}', [Controllers\PetController::class, 'update', 'id']);
});

Route::post('/auth', [Controllers\AuthController::class, 'auth']);
