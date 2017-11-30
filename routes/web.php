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

Route::group(['middleware' => ['roles']], function () {

    //App
    Route::get('/app', 'AppController@index');

    //Profile
    Route::get('/app/profile', 'ProfileController@index');
    Route::get('/app/edit/profile', 'ProfileController@editProfile');
    Route::post('/app/edit/profile', 'ProfileController@saveProfile');

    /*
    //Research
    Route::get('/app/insights', 'AppController@insights');
    Route::get('/app/research', 'AppController@research');
    Route::post('/app/new/research/item', 'ResearchController@saveResearchItem');
    Route::post('/app/new/research/collection', 'ResearchController@saveResearchCollection');
    Route::post('/app/new/research/feed', 'ResearchController@saveResearchFeed');
    */

    //Pages
    Route::get('/app/pages', 'PageController@index');
    Route::get('/app/edit/page/{id}', 'PageController@editPage');
    Route::post('/app/edit/page', 'PageController@savePage');

    //Content
    Route::get('/app/content', 'AppController@content');
    Route::get('/app/new/{slug}', 'PostController@addPost');
    Route::post('/app/new/post', 'PostController@savePost');
    Route::get('/app/view/post/{id}', 'PostController@viewPost');
    Route::get('/app/edit/post/{id}', 'PostController@editPost');
    Route::get('/app/delete/post/{id}', 'PostController@deletePost');
    Route::post('/app/edit/post', 'PostController@savePost');

    //Design
    Route::get('/app/design', 'DesignController@index');

    //Analytics
    Route::get('/app/analytics', 'AppController@analytics');
    Route::get('/app/analytics/mixpanel', 'AppController@mixpanel');

    //Packages
    Route::get('/app/packages', 'PackageController@index');
    Route::post('/app/new/package', 'PackageController@savePackage');
    Route::get('/app/delete/package/{id}', 'PackageController@deletePackage');
    Route::get('/app/update/package/{id}', 'PackageController@updatePackage');
    Route::get('/app/reset/package/{id}', 'PackageController@resetPackage');
    //Route::get('/app/modules', 'ModuleController@index');

    //Route::get('/app/users', 'AppController@users');

    //Schema
    Route::get('/app/schema', 'SchemaController@index');
    Route::get('/app/edit/schema/{slug}', 'SchemaController@editSchema');
    Route::post('/app/edit/schema/{slug}', 'SchemaController@saveSchema');

    //Settings
    Route::get('/app/settings', 'AppController@settings');
    Route::get('/app/edit/setting/{id}', 'SettingController@editSetting');
    Route::post('/app/edit/setting', 'SettingController@saveSetting');

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

//Modules
foreach (Module::enabled() as $module){
    $file = 'app/Modules/'.$module['name'].'/Http/routes.php';
    if (file_exists($file)){
        include $file;
    }
}