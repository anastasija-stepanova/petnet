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

Route::middleware(\App\Http\Middleware\Auth::class)->group(function () {
    Route::post('/user', [Controllers\MyUserController::class, 'create']);

    Route::get('/user/{id}', [Controllers\MyUserController::class, 'get', 'id']);

    Route::delete('/user/{id}', [Controllers\MyUserController::class, 'delete', 'id']);

    Route::post('/user/{id}', [Controllers\MyUserController::class, 'update', 'id']);
});

Route::post('/auth', [Controllers\AuthController::class, 'auth']);
