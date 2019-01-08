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

//Auth
Route::post('/register', 'Auth\RegisterController@create');
Route::post('/activate', 'Auth\RegisterController@activate');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/code_send', 'Auth\LoginController@code_send');
Route::post('/code_check', 'Auth\LoginController@code_check');
Route::post('/password_change', 'Auth\LoginController@password_change');

//Api
Route::post('/post', 'Api\PostController@post');
Route::post('/repost', 'Api\PostController@repost');
Route::post('/sendrepost', 'Api\PostController@sendRepost');
Route::post('/comment', 'Api\PostController@comment');
Route::post('/showcomment', 'Api\PostController@showComment');
Route::post('/like', 'Api\PostController@like');
Route::post('/report', 'Api\PostController@report');
Route::post('/show', 'Api\PostController@show');
Route::post('/favorite', 'Api\PostController@favorite');
Route::post('/suggest', 'Api\PostController@suggest');
Route::get('/terms/{lang}', 'Api\PostController@terms');
Route::get('/aboutus/{lang}', 'Api\PostController@aboutus');

Route::post('/follow', 'Api\UserController@follow');
Route::post('/showfollow', 'Api\UserController@showFollow');
Route::post('/profile', 'Api\UserController@profileFriend');
Route::post('/myprofile', 'Api\UserController@myProfile');
Route::post('/update', 'Api\UserController@update');
Route::post('/reportusers', 'Api\UserController@reportUsers');
Route::post('/block', 'Api\UserController@Block');
Route::post('/showblock', 'Api\UserController@showBlock');
Route::post('/postuser', 'Api\UserController@postUser');
Route::post('/user/notifications', 'Api\User\UserController@notifications');