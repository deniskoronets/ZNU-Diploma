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

	Route::group(['prefix' => 'single'], function() {
		Route::get('/', ['as' => 'getSingleList', 'uses' => 'LessonsController@getSingleList']);
	});
});
