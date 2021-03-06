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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('user', 'AuthController@user');
    Route::resource('tweet', 'TweetController');
    Route::post('tweet/like/{id}', 'TweetController@like');
    Route::get('userdetails', 'HomeController@userDetails');
    Route::get('users/{id}', 'HomeController@userProfile');
    Route::get('mostpopular', 'TagController@mostPopular');
    Route::get('tags/{id}', 'TagController@getTag');
});


