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
    return view('welcome');
});

Route::get('home', function(){
	if (Auth::check()) {
		echo "User " . Auth::user()->name . " is Signed in"; 
	}else{
		echo "No user is signed in";
	}
});

Route::get('show/{image}', function($image){
	return '<img src ="' . asset('img/post_images') .'/'. $image . '"></img>';
});

Route::get('posts/{channel?}', [
	'as'	=>		'posts',
	'uses'	=>		'postsController@index'
]);


/*
| --------------------------------------------------------------------------
| Authentication Routes:
| --------------------------------------------------------------------------
| 
*/


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');



/**
 * Admin Routes
 */

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::resource('sources', 'AdminSourceController');
    Route::resource('channels', 'AdminChannelController');
});

Route::post('ajaxInfoGetter', 
	[ 'as' =>'ajax.info', 'uses'=>'AjaxDataController@getInfo'] );
