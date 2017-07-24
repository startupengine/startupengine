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

// Analytics Summary
Route::get('/v1/analytics/summary', 'APIController@getAnalyticsSummary');

// Web Traffic
Route::get('/v1/analytics/traffic', 'APIController@getTraffic');
Route::get('/v1/analytics/traffic/page/{page}', 'APIController@getTrafficByPage');
Route::get('/v1/analytics/traffic/category/{category}', 'APIController@getTrafficByCategory');

// Events
Route::get('/v1/analytics/events', 'APIController@getEvents');
Route::get('/v1/analytics/events/type/{type}', 'APIController@getEventsByType');

// Content
Route::get('/v1/content/summary', 'APIController@getContentSummary');
Route::get('/v1/content/campaign/{campaign}', 'APIController@getContentByCampaign');

// Users
Route::get('/v1/users/summary', 'APIController@getUsersSummary');

// Experiments
Route::get('/v1/experiments/summary', 'APIController@getExperimentsSummary');
Route::get('/v1/experiments/name/{name}', 'APIController@getExperimentsByName');