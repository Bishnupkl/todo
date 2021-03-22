<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',

], function () {
    Route::post('register', '\App\Http\Controllers\UserController@register');
    Route::post('login', '\App\Http\Controllers\UserController@login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get("user-detail", "\App\Http\Controllers\UserController@userDetail");
        Route::post("create-task", "App\Http\Controllers\TaskController@create");
        Route::get("tasks", "App\Http\Controllers\TaskController@index");
        Route::get("task/{task_id}", "App\Http\Controllers\TaskController@show");
        Route::delete("task/{task_id}", "App\Http\Controllers\TaskController@destroy");

    });
});
