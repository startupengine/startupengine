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

Route::group(['middleware' => ['cors']], function () {

    //////////// API Resources ////////////
    ////// Standard BREAD Operations
    // Browse
    Route::get('/resources/{type}', 'ResourceController@browse')->name('BrowseApiResource');
    // Read
    Route::get('/resources/{type}/{id}', 'ResourceController@read')->name('ReadApiResource');
    // Add
    Route::post('/resources/{type}', 'ResourceController@add')->name('AddApiResource');
    // Edit
    Route::post('/resources/{type}/{id}', 'ResourceController@edit')->name('EditApiResource');
    // Delete
    Route::delete('/resources/{type}/{id}', 'ResourceController@delete')->name('DeleteApiResource');

    ////// Transformation Operations
    // Browse Transformations
    Route::get('/resources/{type}/{id}/transformation/{id}', 'ResourceTransformationController@index')->name('GetApiResourceTransformations');
    // Read Transformation
    Route::get('/resources/{type}/{id}/transformation/{id}', 'ResourceTransformation@view')->name('GetApiResourceTransformation');
    // Add Transformation
    Route::post('/resources/{type}/{id}/transformation/', 'ResourceController@add')->name('AddApiResourceTransformation');

    // Analytics
    Route::get('/analytics/count', 'ResourceController@count')->name('CountAnalyticsEvents');

    //////////// Third-Party APIs ////////////
    ////// Stripe
    // Browse Payment Methods
    Route::get('/stripe/payments/methods', 'StripeController@browsePaymentMethods')->name('BrowseStripePaymentMethods');
    // Read Payment Method
    Route::get('/stripe/payments/method/{id}', 'StripeController@readPaymentMethod')->name('ReadStripePaymentMethod');
    // Add Payment Methods
    Route::post('/stripe/payments/method', 'StripeController@storePaymentMethod')->name('StoreStripePaymentMethod');

});

// Demo Data
Route::get('/demo/menu', 'DemoController@menu');
Route::get('/demo/user', 'DemoController@user');
Route::get('/demo/user/{id}/activities', 'DemoController@userActivities');
Route::get('/demo/users', 'DemoController@users');
Route::get('/demo/pages', 'DemoController@pages');
Route::get('/demo/content//content/models', 'DemoController@contentModels');
Route::get('/demo/products', 'DemoController@products');
Route::get('/demo/dashboard/analytics', 'DemoController@dashboardAnalytics');
Route::get('/demo/dashboard/social', 'DemoController@dashboardSocialFeed');
Route::get('/demo/dashboard/content', 'DemoController@dashboardRecentContent');
Route::get('/demo/notifications', 'DemoController@notifications');


/* OLD API ROUTES
// Users
Route::get('/users', 'APIController@getUsers');

// Products
Route::get('/products', 'APIController@getProducts');
Route::get('/products/view/{id}', 'APIController@findProduct');
Route::get('/products/edit/{id}', 'APIController@editProduct');
Route::get('/products/new', 'APIController@newProduct');
Route::get('/products/plans', 'APIController@getProductPlans');
Route::get('/products/plans/edit', 'APIController@editProductPlans');
Route::get('/products/plans/schema', 'APIController@getProductPlanSchema');


// Analytics
Route::get('/analytics/events/{type}', 'APIController@getEvents');
Route::get('/analytics/events/{type}/{key}', 'APIController@getEventsWithKey');
Route::get('/analytics/events/{type}/{key}/{value}', 'APIController@getEventsByKeyAndValue');
Route::get('/analytics/event/', 'APIController@saveEvent');
Route::post('/analytics/event/', 'APIController@saveEvent');

// Pages
Route::get('/page/{slug}', 'APIController@getPage');
Route::get('/page/{slug}/edit', 'APIController@editPage');
Route::get('/page/{slug}/random', 'APIController@getRandomPageVariation');
Route::get('/pages', 'APIController@getPages');

// Content
// Single Item
Route::get('content/item', 'APIController@getItem');
Route::get('content/item/new', 'APIController@newItem');
Route::get('content/item/{id}', 'APIController@findItem');
Route::get('content/item/edit/{id}', 'APIController@editItem');
Route::post('content/item/edit/{id}', 'APIController@editItem');
Route::get('content/item/edit/{id}/validate', 'APIController@validateInput');
Route::post('content/item/edit/{id}/validate', 'APIController@validateInput');
//Collections
Route::get('content/items', 'APIController@getItems');
Route::get('content', 'APIController@getPosts');
//Models
Route::get('content/models', 'APIController@getContentModels');

//Search
Route::get('/search/', 'APIController@search');

//Stripe
Route::get('stripe/products/', 'APIController@getStripeProducts');
Route::get('stripe/new/product/', 'APIController@createProduct');
Route::post('stripe/new/product/', 'APIController@createProduct');
Route::get('stripe/new/product/plan', 'APIController@createProductPlan');
Route::post('stripe/new/product/plan', 'APIController@createProductPlan');
Route::get('subscriptions/create', 'APIController@createSubscription');
Route::get('stripe/plans/', 'APIController@getStripePlans');
Route::get('invoices/user/{id}', 'APIController@getInvoices');

//Github
Route::get('repo/github/json/{filepath?}', 'GithubController@json')->where('filepath', '(.*)');
Route::get('repo/github/raw/{filepath?}', 'GithubController@raw')->where('filepath', '(.*)');
Route::get('repo/github/info/{filepath?}', 'GithubController@info')->where('filepath', '(.*)');
*/

//Modules
foreach (Module::enabled() as $module) {
    $file = '/app/Modules/' . $module['name'] . '/Http/Routes/api.php';
    if (file_exists($file)) {
        include $file;
    }
}