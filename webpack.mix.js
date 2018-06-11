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
   .sass('resources/assets/sass/app.scss', 'public/css');
   
mix.styles([
    'resources/assets/front/css/bootstrap.min.css',
    'resources/assets/front/css/font-awesome.min.css',
    'resources/assets/front/css/animate.min.css',
    'resources/assets/front/css/owl.carousel.css',
    'resources/assets/front/css/owl.theme.css',
    'resources/assets/front/css/owl.transitions.css',
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/responsive.css'
], 'public/css/front.css');

mix.scripts([
    'resources/assets/front/js/jquery-1.11.3.min.js',
    'resources/assets/front/js/bootstrap.min.js',
    'resources/assets/front/js/owl.carousel.min.js',
    'resources/assets/front/js/jquery.stickit.min.js',
    'resources/assets/front/js/scripts.js'
], 'public/js/front.js');

mix.copy('resources/assets/front/fonts', 'public/fonts');