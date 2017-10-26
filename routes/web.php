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

Auth::routes();

Route::group(['middleware' => ['roles']], function () {

    //App
    Route::get('/app', 'AppController@index');
    Route::get('/app/insights', 'AppController@insights');
    Route::get('/app/content', 'AppController@content');
    Route::get('/app/new/post', 'PostController@addPost');
    Route::post('/app/new/post', 'PostController@savePost');
    Route::get('/app/analytics', 'AppController@analytics');
    Route::get('/app/analytics/mixpanel', 'AppController@mixpanel');
    Route::get('/app/users', 'AppController@users');
    Route::get('/app/settings', 'AppController@settings');

    //Voyager
    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });

});

//Web Middleware
Route::group(['middleware' => ['web']], function () {

    //Auth
    Route::get('/login', 'AppController@login')->name('login');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/register', ['uses' => '\App\Http\Controllers\Auth\LoginController@logout', 'as' => 'page']);
    Route::get('/app/login', 'AppController@login');

    //Pages
    Route::get('/', 'PageController@getHomepage');
    Route::get('/home', 'PageController@getHomepage');

    Route::get('/{slug}', 'PageController@getPage');
    Route::get('/content/{slug}', ['uses' => 'PostController@getPost', 'as' => 'page']);
    Route::get('/help', ['uses' => 'HelpController@index', 'as' => 'page']);
    Route::get('/help/{slug}', ['uses' => 'HelpController@getArticle', 'as' => 'page']);

});