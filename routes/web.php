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
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/admin'], function(){
    Route::get('/login', 'Admin\AuthController@login_view');
    Route::post('/login', 'Admin\AuthController@login');

    Route::group(['middleware' => ['web', IsAdmin::class]], function () {
        
        Route::get('/dashboard', 'Admin\HomeController@index');
        Route::get('/logout', 'Admin\AuthController@logout');

        Route::get('/users/admins', 'Admin\UserController@admins');
        Route::get('/users/active', 'Admin\UserController@active');
        Route::get('/users/suspended', 'Admin\UserController@suspended');
        Route::post('/user/adminize', 'Admin\UserController@adminize');
        Route::get('/user/create', 'Admin\UserController@create');
        Route::get('/user/createadmin', 'Admin\UserController@create');
        Route::post('/user/store', 'Admin\UserController@store');
        Route::post('/user/storeadmin', 'Admin\UserController@storeadmin');
        Route::get('/user/{id}/change_status', 'Admin\UserController@change_status');
        Route::post('/user/delete', 'Admin\UserController@destroy');

        Route::get('/posts', 'Admin\PostController@index');
        Route::get('/posts/view/{id}', 'Admin\PostController@view');
        Route::post('/posts/delete', 'Admin\PostController@destroy');
        
        Route::group(['prefix' => '/settings'], function () {

            Route::get('/about', 'Admin\SettingController@index');
            Route::get('/about/edit', 'Admin\SettingController@edit');
            Route::post('/about/update', 'Admin\SettingController@update');

            Route::get('/term', 'Admin\SettingController@terms');
            Route::get('/term/edit', 'Admin\SettingController@editterms');
            Route::post('/term/update', 'Admin\SettingController@updateterms');

            Route::get('/suggestion', 'Admin\SettingController@suggestion');
        });
    });
});
