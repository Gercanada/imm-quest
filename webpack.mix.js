const mix = require('laravel-mix');
require('dotenv').config();


// new webpack.EnvironmentPlugin(['APP_ENV', 'MIX_APP_ENV']);
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



mix.js(['resources/js/app.js', ], 'public/js/')
    .vue()
    .minify('public/js/app.js');
/*  .combine([

 ], 'public/css/main.css') */