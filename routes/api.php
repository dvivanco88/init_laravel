<?php

use Illuminate\Http\Request;

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


Route::group(['prefix' => 'enterprises'], function () {
    Route::resource('enterprises', 'Enterprises\EnterpriseAPIController');
});

Route::group(['prefix' => 'users'], function () {
    Route::resource('users', 'Enterprises\EnterpriseAPIController');
});






Route::resource('rols', 'rolAPIController');