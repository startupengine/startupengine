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

use Caffeinated\Modules\Facades\Module;

Auth::routes();

Route::group(['middleware' => ['permission:view backend', 'backend']], function () {

    //App
    Route::get('/app', 'AppController@index');

    //Profile
    Route::group(['middleware' => ['role:staff']], function () {
        Route::get('/app/profile', 'ProfileController@index');
        Route::get('/app/edit/profile', 'ProfileController@editProfile');
        Route::post('/app/edit/profile', 'ProfileController@saveProfile');
    });

    //Settings
    Route::group(['middleware' => ['permission:edit settings']], function () {
        Route::get('/app/settings', 'SettingController@index');
        Route::get('/app/new/setting', 'SettingController@addSetting');
        Route::get('/app/edit/setting/{id}', 'SettingController@editSetting');
        Route::post('/app/edit/setting', 'SettingController@saveSetting');
    });
    //API Settings
    Route::group(['middleware' => ['permission:manage api settings']], function () {
        Route::get('/app/settings/api', 'AppController@api');
    });

    //Pages
    Route::group(['middleware' => ['permission:edit pages']], function () {
        Route::get('/app/pages', 'PageController@index');
        Route::get('/app/new/page', 'PageController@addPage');
        Route::get('/app/edit/page/{id}', 'PageController@editPage');
        Route::post('/app/edit/page', 'PageController@savePage');
    });

    //Users
    Route::group(['middleware' => ['permission:edit users']], function () {
        Route::get('/app/users', 'UserController@index');
        Route::get('/app/new/user', 'UserController@newUser');
        Route::post('/app/new/user', 'UserController@saveUser');
        Route::get('/app/view/user/{id}', 'UserController@viewUser');
        Route::get('/app/edit/user/{id}', 'UserController@editUser');
        Route::post('/app/edit/user', 'UserController@saveUser');
        Route::get('/app/delete/user/{id}', 'UserController@deleteUser');
    });

    //Roles
    Route::group(['middleware' => ['permission:browse roles']], function () {
        Route::get('/app/roles', 'RoleController@index');
        Route::get('/app/edit/role/{id}', 'RoleController@edit');
    });

    //Content
    Route::group(['middleware' => ['permission:browse posts|browse own posts']], function () {
        Route::get('/app/content', 'PostController@index');
        Route::get('/app/new/{slug}', 'PostController@addPost');
        Route::post('/app/new/post', 'PostController@savePost');
        Route::get('/app/view/post/{id}', 'PostController@viewPost');
        Route::get('/app/edit/post/{id}', 'PostController@editPost');
        Route::get('/app/delete/post/{id}', 'PostController@deletePost');
        Route::post('/app/edit/post', 'PostController@savePost');
    });

    //Design
    Route::group(['middleware' => ['permission:edit settings']], function () {
        Route::get('/app/design', 'DesignController@index');
    });

    //Analytics
    Route::group(['middleware' => ['permission:view analytics']], function () {
        Route::get('/app/analytics', 'AnalyticsController@index');
        Route::get('/app/analytics/mixpanel', 'AnalyticsController@mixpanel');
    });

    //Packages
    Route::group(['middleware' => ['permission:edit packages']], function () {
        Route::get('/app/packages', 'PackageController@index');
        Route::post('/app/new/package', 'PackageController@savePackage');
        Route::get('/app/delete/package/{id}', 'PackageController@deletePackage');
        Route::get('/app/update/package/{id}', 'PackageController@updatePackage');
        Route::get('/app/reset/package/{id}', 'PackageController@resetPackage');
    });

    //Modules
    //Route::get('/app/modules', 'ModuleController@index');

    //Schema
    Route::group(['middleware' => ['permission:edit content types']], function () {
        Route::get('/app/schema', 'SchemaController@index');
        Route::get('/app/new/schema', 'SchemaController@addSchema');
        Route::get('/app/edit/schema/{slug}', 'SchemaController@editSchema');
        Route::post('/app/edit/schema/{slug}', 'SchemaController@saveSchema');
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
    Route::get('/', 'PageController@getHomepage')->name('home');
    Route::get('/home', 'PageController@getHomepage');

    Route::get('/{slug}', 'PageController@getPage');
    Route::get('/content/{slug}', ['uses' => 'PostController@getPost', 'as' => 'page']);
    Route::get('/help', ['uses' => 'HelpController@index', 'as' => 'page']);
    Route::get('/help/{slug}', ['uses' => 'HelpController@getArticle', 'as' => 'page']);

});

//Modules
foreach (Module::enabled() as $module){
    $file = 'app/Modules/'.$module['name'].'/Http/routes.php';
    if (file_exists($file)){
        include $file;
    }
}