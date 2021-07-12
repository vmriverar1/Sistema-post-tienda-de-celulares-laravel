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
    .vue()
    .scripts([
        'resources/js/admin.js',
        'resources/js/funciones.js',
        'resources/js/ajax.js'
    ],'public/js/admin.js')
    .scripts([
        'resources/js/tienda.js'
    ],'public/js/tienda.js')
    .sass('resources/sass/app.scss', 'public/css');
