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

Route::get('/browse/', 'APIController@getItemsByCategory');
Route::get('/items/', 'APIController@getItems');
Route::get('/item/', 'APIController@getItem');
Route::get('/random/', 'APIController@getRandomItem');
Route::get('/search/', 'APIController@search');