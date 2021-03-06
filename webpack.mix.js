const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/images-preview.js', 'public/js')
    .js('resources/js/images-actions.js', 'public/js')
    // .js('resources/js/iziToast.js', 'public/js')
    .js('resources/js/paypal-payments.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/iziToast.css', 'public/css')
    .sourceMaps();
