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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Traffic
Route::get('/v1/traffic', 'APIController@getTraffic'); // Get all traffic [DONE]
Route::get('/v1/traffic/path/{path}', 'APIController@getTraffic'); // Get traffic stats for a particular path [DONE]

// Events
Route::get('/v1/events', 'APIController@getEvents'); // Lists all events (interactions such as clicks, shares, etc) [DONE]
Route::get('/v1/events/type/{type}', 'APIController@getEventsByType'); // Lists all events of a specific type [DONE]

// Content
Route::get('/v1/content/type/{type}', 'APIController@getContentByType'); // List all content of a specified type (i.e. campaign, page, help, landing) [DONE]
Route::get('/v1/content/campaign/{campaign}', 'APIController@getContentByCampaign'); // List content (pages) for a certain campaign [DONE]
Route::get('/v1/content/campaign/{campaign}/type/{type}', 'APIController@getContentByCampaign'); // List specified content of a certain type for a certain campaign [DONE]

// Perform Raw Analytics Query
Route::get('/v1/analytics/query', 'APIController@performQuery'); // Perform a manual query on the Google Analytics API