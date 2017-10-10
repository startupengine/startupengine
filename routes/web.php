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

//Authentication
Auth::routes();
Route::get('/auth0', '\Auth0\Login\Auth0Controller@callback');
Route::get('/callback', '\Auth0\Login\Auth0Controller@callback');
Route::get('/auth0/callback', '\Auth0\Login\Auth0Controller@callback');

if(config('laravel-auth0.mode') == 'hosted') {
    Route::get('/login', 'AppController@login')->name('login');
}
else {
    Route::get('/login', 'AppController@loginWidget')->name('login');
}

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

//Web Middleware
Route::group(['middleware' => ['web']], function () {
    //Homepage
    Route::get('/', 'PageController@getHomepage');
    Route::get('/about', 'PageController@getHomepage');

    //Install
    Route::get('/install', 'SettingsController@install');

    //Settings
    Route::post('/install', 'SettingsController@installContentful');

    //Import
    Route::get('/install/import', 'ContentfulController@import');
    Route::get('/install/import-complete', 'SettingsController@importComplete');

    //Admins
    Route::get('/admin', 'AdminController@index');//->middleware('auth');
    Route::get('/admin/analytics', 'AdminController@analytics');//->middleware('auth');
    Route::get('/admin/content', 'AdminController@content')->middleware('auth');
    Route::get('/admin/content/topic', 'AdminController@topic')->middleware('auth');
    Route::get('/admin/content/campaign', 'AdminController@campaign')->middleware('auth');
    Route::get('/admin/postscheduling', 'AdminController@postscheduling')->middleware('auth');
    Route::get('/admin/apps', 'AdminController@apps')->middleware('auth');

    //Pages
    Route::get('/articles', 'PageController@getArticles');
    Route::get('/help', ['uses' => 'HelpController@index', 'as' => 'article']);
    Route::get('/{slug}', ['uses' => 'PageController@getArticle', 'as' => 'article']);
    Route::get('/article/{slug}', ['uses' => 'PageController@getArticle', 'as' => 'article']);
    Route::get('/landing/{slug}', ['uses' => 'PageController@getArticle', 'as' => 'article']);
    Route::get('/product/{slug}', ['uses' => 'PageController@getArticle', 'as' => 'article']);
    Route::get('/service/{slug}', ['uses' => 'PageController@getArticle', 'as' => 'article']);
    Route::get('/help/{slug}', ['uses' => 'HelpController@getArticle', 'as' => 'article']);
    Route::get('/form/{slug}', ['uses' => 'PageController@getArticle', 'as' => 'article']);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
