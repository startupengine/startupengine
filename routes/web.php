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
Route::get('/auth0/callback', '\Auth0\Login\Auth0Controller@callback');

//Web Middleware
Route::group(['middleware' => ['web']], function () {
    //Homepage
    Route::get('/', 'ArticleController@getHomepage');
    Route::get('/about', 'ArticleController@getHomepage');

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
    Route::get('/admin/content', 'AdminController@content');//->middleware('auth');
    Route::get('/admin/postscheduling', 'AdminController@postscheduling');//->middleware('auth');
    Route::get('/admin/settings', 'AdminController@settings');//->middleware('auth');

    //Users
    Route::get('/app', 'HomeController@index')->name('home')->middleware('auth');

    //Pages
    Route::get('/articles', 'ArticleController@getArticles');
    Route::get('/{slug}', ['uses' => 'ArticleController@getArticle', 'as' => 'article']);
    Route::get('/article/{slug}', ['uses' => 'ArticleController@getArticle', 'as' => 'article']);
    Route::get('/landing/{slug}', ['uses' => 'ArticleController@getArticle', 'as' => 'article']);
});