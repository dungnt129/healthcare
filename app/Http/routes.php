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

Route::get('/', function () {
    return redirect()->route('user.list');
});

Route::get('test', [
	'as' => 'test',
	'uses' => 'TestController@index'
]);

/* Login route */
Route::get('login', [
	'as' => 'login',
	'uses' => 'LoginController@index'
]);

Route::post('login', [
	'as' => 'login.submit',
	'uses' => 'LoginController@postLogin'
]);

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'LoginController@getLogout'
]);

Route::group([
	'middleware' => 'auth.login'
], function()
{

	/* User route */
//	Route::get('user/detail/{user_id}', [
//		'as' => 'user.detail',
//		'uses' => 'UserController@detail'
//	]);

	Route::get('user/list', [
		'as' => 'user.list',
		'uses' => 'UserController@index'
	]);

	Route::get('user/create', [
		'as' => 'user.create',
		'uses' => 'UserController@create'
	]);

	Route::get('user/update/{user_id}', [
		'as' => 'user.update',
		'uses' => 'UserController@update'
	]);

	Route::post('user/save', [
		'as' => 'user.save',
		'uses' => 'UserController@save'
	]);

	Route::get('user/delete/{user_id}', [
		'as' => 'user.delete',
		'uses' => 'UserController@delete'
	]);
});
