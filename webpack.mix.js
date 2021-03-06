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

mix.styles([
        'resources/assets/sb-admin-2/css/sb-admin-2.min.css',
        'resources/assets/vendor/fontawesome/css/all.min.css',
        'resources/assets/sb-admin-2/vendor/datatables/datatables.bootstrap4.min.css',
    ], 'public/css/portal.css')
    .scripts([
        'resources/assets/vendor/jquery/jquery.min.js',
        'resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/assets/vendor/jquery-easing/jquery.easing.min.js',
        'resources/assets/vendor/fontawesome/js/all.min.js',
        'resources/assets/sb-admin-2/js/sb-admin-2.min.js',
        'resources/assets/sb-admin-2/vendor/chart.js/Chart.min.js',
        'resources/assets/sb-admin-2/vendor/datatables/jquery.datatables.min.js',
        'resources/assets/sb-admin-2/vendor/datatables/datatables.bootstrap4.min.js',
    ], 'public/js/portal.js')
    .scripts('resources/assets/sb-admin-2/js/demo/chart-area-demo.js', 'public/js/components/chart-area.js')
    .scripts('resources/assets/sb-admin-2/js/demo/chart-pie-demo.js', 'public/js/components/chart-pie.js')
    .scripts('resources/assets/sb-admin-2/js/demo/chart-bar-demo.js', 'public/js/components/chart-bar.js')
    .scripts('resources/assets/sb-admin-2/js/demo/datatables-demo.js', 'public/js/components/datatables.js')
    .styles([
        'resources/assets/vendor/fontawesome/css/all.min.css',
        'resources/assets/sb-admin-2/css/sb-admin-2.min.css',
        'resources/assets/vendor/bootstrap/css/bootstrap.min.css',
        'resources/assets/grayscale/css/grayscale.min.css',
    ], 'public/css/public.css')
    .scripts([
        'resources/assets/vendor/jquery/jquery.min.js',
        'resources/assets/vendor/jquery-easing/jquery.easing.min.js',
        'resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/assets/vendor/fontawesome/js/all.min.js',
        'resources/assets/grayscale/js/grayscale.min.js',
    ], 'public/js/public.js');