<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/page_1', function () {
    return 'It`s my page 1';
});

Route::get('/posts', [Controllers\PostController::class, 'index']);

Route::get('/posts/create', [Controllers\PostController::class, 'create']);

Route::get('/posts/update', [Controllers\PostController::class, 'update']);

Route::get('/posts/delete', [Controllers\PostController::class, 'delete']);

Route::get('/posts/first_or_create', [Controllers\PostController::class, 'firstOrCreate']);

Route::get('/posts/update_or_create', [Controllers\PostController::class, 'updateOrCreate']);

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
