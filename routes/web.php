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

// Use Custom Modules
use Caffeinated\Modules\Facades\Module;

Route::post('/api/new-register', 'Api\UsersController@create');

Route::group(
    ['middleware' => ['web', 'permission:view backend', 'backend']],
    function () {
        Route::get('/admin/', 'AppController@index')->name('admin');
    }
);

// User Facing Front-End
Route::group(['middleware' => ['web']], function () {
    //Authentication
    Auth::routes(['verify' => true]);
    Route::get(
        '/email/verify/{id}',
        'Auth\VerificationController@verify'
    )->name('verify');

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get(
        '/logout',
        '\App\Http\Controllers\Auth\LoginController@logout'
    )->name('logout');
    Route::get('/register', [
        'uses' => '\App\Http\Controllers\Auth\LoginController@register'
    ])->name('register');

    //Styles
    Route::get('/styles.css', 'CssController@render')->name('renderCss');
    Route::get('/styles/{file}', 'CssController@view')->name('viewCss');

    //Javascript
    Route::get('/js/{file}', 'JsController@render')->name('js');

    //Documentation
    Route::get('/docs', 'ApiDocsController@index')->name('browseDocs');
    Route::get('/docs/{file}', 'ApiDocsController@view')->name('viewDocs');
    Route::get('/docs/{folder}/{file}', 'ApiDocsController@viewNested')->name(
        'viewNestedDocs'
    );
    Route::get(
        '/docs/{folder}/{subfolder}/{file}',
        'ApiDocsController@viewSubNested'
    )->name('viewSubNestedDocs');

    //Content
    Route::get('/content/type/{type}', 'PostController@getItemsByType')->name(
        'contentByType'
    );
    Route::get('/content/tags/{tag}', 'PostController@getItemsByTag')->name(
        'contentByTag'
    );
    Route::get('/content/tags', 'PostController@getItemsByTag')->name(
        'contentTagIndex'
    );
    Route::group(['middleware' => ['webrbac']], function () {
        Route::get('/content/{id}/{slug}', 'PostController@getItem')->name(
            'contentById'
        );
        Route::get('/content/{id}', 'PostController@getItem')->name(
            'contentById'
        );
        Route::get(
            '/content/{postType}/{tag}',
            'PostController@getPostByPostTypeAndSlug'
        )->name('contentByTagAndType');
    });

    Route::group(['middleware' => ['webrbac']], function () {
        //Pages
        Route::get('/', 'PageController@getHomepage')->name('homepage');
        Route::get('/home', 'PageController@getHomepage')->name('home');
        Route::get('/{slug}', 'PageController@getPage')->name('view page');
    });

    //Product Pages
    Route::get('/products/{id}', 'ProductController@viewProductPage')->name(
        'viewProductPage'
    );

    //Feature Pages
    Route::get('/features/{slug}', 'FeatureController@viewFeaturePage')->name(
        'viewFeaturePage'
    );

    //Subscribe
    Route::get(
        '/subscribe/{product_id}/{plan_id}',
        'SubscriptionController@addSubscription'
    )
        ->name('newSubscription')
        ->middleware('auth.default');

    //App
    Route::get('/app/{accountView}', 'AccountController@view')
        ->name('account')
        ->middleware('auth.default');
    Route::get(
        '/app/{accountView}/{accountSubView}',
        'AccountController@subView'
    )
        ->name('accountSubview')
        ->middleware('auth.default');
});

// Admin Control Panel
Route::group(
    ['middleware' => ['web', 'permission:view backend', 'backend']],
    function () {
        // Dashboard
        Route::get('/admin/dashboard', 'AppController@index')->name(
            'dashboard'
        );

        // Pages
        Route::get('/admin/pages', 'PageController@index')->name(
            'adminPageIndex'
        );
        Route::get('/admin/pages/{id}', 'PageController@view')->name(
            'adminPageView'
        );

        // Content
        Route::get('/admin/content', 'ContentController@index')->name(
            'adminContentIndex'
        );
        Route::get('/admin/content/{id}', 'ContentController@view')->name(
            'adminContentView'
        );

        // Users
        Route::get('/admin/users', 'UserController@index')->name(
            'adminUserIndex'
        );
        Route::get('/admin/users/{id}', 'UserController@view')->name(
            'adminUserView'
        );
        Route::get(
            '/admin/users/{id}/preferences',
            'UserPreferencesController@index'
        )->name('adminUserPreferenceIndex');

        // Products
        Route::get('/admin/products', 'ProductController@index')->name(
            'adminProductIndex'
        );
        Route::get('/admin/products/{id}', 'ProductController@view')->name(
            'adminProductView'
        );

        // Features
        Route::get('/admin/features', 'FeatureController@index')->name(
            'adminFeatureIndex'
        );
        Route::get('/admin/features/{id}', 'FeatureController@view')->name(
            'adminFeatureView'
        );

        // Analytics
        Route::get('/admin/analytics', 'AnalyticsController@index')->name(
            'analytics'
        );

        // Logs
        Route::get('/admin/logs', 'LogController@index')->name('adminLogIndex');
        Route::get('/admin/logs/{id}', 'LogController@view')->name(
            'adminLogView'
        );

        // Settings
        Route::get('/admin/settings', 'SettingController@index')->name(
            'adminSettingIndex'
        );
        Route::get('/admin/settings/{id}', 'SettingController@view')->name(
            'adminSettingView'
        );
        Route::get(
            '/admin/settings/group/{group}',
            'SettingGroupController@index'
        )->name('adminSettingGroupIndex');

        //Preference Schemas
        Route::get(
            '/admin/preferences/schemas',
            'PreferenceSchemaController@index'
        );
        Route::get(
            '/admin/preferences/schemas/{id}',
            'PreferenceSchemaController@view'
        );

        //Preferences
        Route::get('/admin/preference/{id}', 'PreferenceController@view');

        //Websockets
        Route::get('/admin/realtime', 'WebsocketController@index')->name(
            'realtime'
        );
    }
);
//Custom Module Routes
foreach (Module::enabled() as $module) {
    $file = '/app/Modules/' . $module['name'] . '/Http/Routes/web.php';
    if (file_exists($file)) {
        include $file;
    }
}

Route::get('/home', 'HomeController@index')->name('home');
