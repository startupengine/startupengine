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

// Overview
Route::get('/v1/overview', 'APIController@getOverview')->middleware('apisecret');

// Status
Route::get('/v1/status/summary', 'APIController@getStatusSummary');
Route::get('/v1/status/{name}', 'APIController@getStatusByName');

// Traffic
Route::get('/v1/traffic', 'APIController@getTrafficSummary');
Route::get('/v1/traffic/page/{page}', 'APIController@getTrafficByPage');
Route::get('/v1/traffic/type/{type}', 'APIController@getTrafficByType');

// Events
Route::get('/v1/events', 'APIController@getEventsSummary');
Route::get('/v1/events/type/{type}', 'APIController@getEventsByType');

// Content
Route::get('/v1/content/summary', 'APIController@getContentSummary');
Route::get('/v1/content/campaign/{campaign}', 'APIController@getContentByCampaign');
Route::get('/v1/content/type/{type}', 'APIController@getContentByType');

// Products
Route::get('/v1/products/summary', 'APIController@getProductSummary');
Route::get('/v1/products/{name}', 'APIController@getProductByName');

// Services
Route::get('/v1/services/summary', 'APIController@getServiceSummary');
Route::get('/v1/services/{name}', 'APIController@getServiceByName');

// Subscriptions
Route::get('/v1/subscriptions/summary', 'APIController@getSubscriptionSummary');
Route::get('/v1/subscriptions/{name}', 'APIController@getSubscriptionByName');

// Revenue
Route::get('/v1/revenue/summary', 'APIController@getRevenueSummary');

// Users
Route::get('/v1/users/summary', 'APIController@getUsersSummary');

// Experiments
Route::get('/v1/experiments/summary', 'APIController@getExperimentsSummary');
Route::get('/v1/experiments/name/{name}', 'APIController@getExperimentsByName');

// Campaigns
Route::get('/v1/campaigns/summary', 'APIController@getCampaignSummary');
Route::get('/v1/campaigns/{campaign}/stages', 'APIController@getCampaignStages');
Route::get('/v1/campaigns/{campaign}/notes', 'APIController@getCampaignNotes');
Route::get('/v1/campaigns/{campaign}/content', 'APIController@getCampaignContent');
Route::get('/v1/campaigns/{campaign}/traffic', 'APIController@getCampaignTraffic');
Route::get('/v1/campaigns/{campaign}/events', 'APIController@getCampaignEvents');
Route::get('/v1/campaigns/{campaign}/users', 'APIController@getCampaignUsers');
Route::get('/v1/campaigns/{campaign}/revenue', 'APIController@getCampaignRevenue');
Route::get('/v1/campaigns/{campaign}/experiments', 'APIController@getCampaignExperiments');