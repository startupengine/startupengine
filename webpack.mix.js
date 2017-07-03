let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/custom.scss', 'public/css');;
mix.copy('resources/assets/webslides/static/css', 'public/css');
mix.copy('resources/assets/webslides/static/images', 'public/images');
mix.copy('resources/assets/webslides/static/js', 'public/js');