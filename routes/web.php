<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/




Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@web_page')->name('web_page');



Auth::routes();

Route::group(['prefix' => '/', 'middleware'  =>  'auth'], function () {

	Route::group(['middleware' => ['checkPermission']], function () {
		Route::resource('rols', 'rolController');
		Route::get('rols/{rol}/permissions', 'rolController@permissions')->name('rols.permissions');
		Route::post('rols/{rol}/permissions/submitted', 'rolController@submitted')->name('rols.submitted');
		Route::delete('rols/{rol}/permissions/destroy_permission/{permission}', 'rolController@submitted_delete')->name('rols.submitted_delete');
		Route::resource('users', 'UserController');
		Route::resource('enterprises', 'Enterprises\EnterpriseController', ["as" => 'enterprises']);
	});

	Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('scaffolding');

	Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

	Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate');

	Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

	Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback');

	Route::post(
		'generator_builder/generate-from-file',
		'\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
	);
	
});