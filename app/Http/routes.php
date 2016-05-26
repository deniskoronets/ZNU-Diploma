<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'lessons', 'as' => 'lessons.'], function() {
	Route::get('/', ['as' => 'getList', 'uses' => 'LessonsController@getList']);
	Route::any('new', ['as' => 'create', 'uses' => 'LessonsController@create']);

	Route::group(['prefix' => 'single', 'as' => 'single.'], function() {
		Route::get('/', ['as' => 'getSingleList', 'uses' => 'LessonsController@getSingleList']);
		Route::any('/new', ['as' => 'createSingle', 'uses' => 'LessonsController@createSingle']);
		Route::get('/download', ['as' => 'singleToPdf', 'uses' => 'LessonsController@singleToPdf']);
	});
});

Route::group(['prefix' => 'load', 'as' => 'load.'], function() {
	Route::get('/', ['as' => 'getList', 'uses' => 'LoadController@getList']);
	Route::any('/new', ['as' => 'create', 'uses' => 'LoadController@create']);
});