<?php

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

Route::prefix('post')->group(function () {
    Route::match(['get', 'post'], 'search', 'PostController@search');
});

Route::prefix('user')->group(function () {
    Route::match(['get', 'post'], 'search', 'UserController@search');
});

Route::apiResource('post', 'PostController');
Route::apiResource('user', 'UserController');
