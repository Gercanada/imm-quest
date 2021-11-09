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
    .scripts('node_modules/admin-lte/plugins/jquery-mapael/jquery.mapael.js', 'public/jq/plugins.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')

    .copy('node_modules/admin-lte/dist/img', 'public/admin-lte/images', true)

    .copy([
        'node_modules/admin-lte/plugins/jquery/jquery.min.js',
        'node_modules/admin-lte/plugins/jquery-mapael/jquery.mapael.min.js',
        'node_modules/admin-lte/plugins/jquery-mousewheel/jquery.mousewheel.js',
        'node_modules/admin-lte/plugins/raphael/raphael.min.js',
        'node_modules/admin-lte/plugins/jquery-mapael/jquery.mapael.min.js',
        'node_modules/admin-lte/plugins/jquery-mapael/maps/usa_states.min.js',
        'node_modules/admin-lte/plugins/chart.js/Chart.min.js'
    ], 'public/admin-lte/plugins', true)
    .copy([
        'node_modules/admin-lte/dist/js/demo.js',
        'node_modules/admin-lte/dist/js/pages/dashboard2.js'
    ], 'public/admin-lte/dist', true);
