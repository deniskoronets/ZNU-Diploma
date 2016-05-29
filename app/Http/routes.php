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
	Route::any('/{id}/edit', ['as' => 'update', 'uses' => 'LessonsController@update']);
	Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'LessonsController@delete']);
	Route::get('/download', ['as' => 'toPdf', 'uses' => 'LessonsController@toPdf']);

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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

	Route::get('/', ['uses' => 'Admin\DashboardController@index', 'as' => 'dashboard.index']);

	Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
		Route::get('/', ['uses' => 'Admin\UsersController@getList', 'as' => 'getList']);
		Route::any('new', ['uses' => 'Admin\UsersController@create', 'as' => 'create']);
		Route::any('{id}/edit', ['uses' => 'Admin\UsersController@update', 'as' => 'update']);
	});

	Route::group(['prefix' => 'faculties', 'as' => 'faculties.'], function() {
		Route::get('/', ['uses' => 'Admin\FacultiesController@getList', 'as' => 'getList']);
		Route::any('new', ['uses' => 'Admin\FacultiesController@create', 'as' => 'create']);
		Route::any('{id}/edit', ['uses' => 'Admin\FacultiesController@update', 'as' => 'update']);
	});
});