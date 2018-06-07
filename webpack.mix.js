const { mix } = require('laravel-mix');

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

// AUTH

mix.styles([
    'public/themes/auth/css/font-awesome.css',
    'public/themes/auth/css/bootstrap.css',
    'public/themes/auth/css/notify__custom.css',
    'public/themes/auth/css/nprogress.css',
    'public/themes/auth/css/animate.css',
    'public/themes/auth/css/custom.css',
    'public/js/bower_components/pacejs/pace-theme-flash.css',
    'public/js/bower_components/iCheck/skins/flat/flat.css',
    'public/themes/auth/css/pop__up.css',
    'public/js/bower_components/hold-on/HoldOn.min.css',
    'public/js/bower_components/sweetalert/dist/sweetalert.css',
    'public/js/bower_components/icheck-bootstrap/icheck-bootstrap.min.css',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.min.css',
    'public/js/bower_components/air-datepicker-master/dist/css/datepicker.css',
    'public/js/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.css',
    'public/js/bower_components/chosen/chosen.css',
], 'public/themes/auth/build/css/style.css');

mix.scripts([
    'public/js/bower_components/jquery/dist/jquery.min.js',
    'public/js/bower_components/jquery/dist/jquery-ui.js',
    'public/js/bower_components/iCheck/icheck.min.js',
    'public/js/bower_components/hold-on/HoldOn.min.js',
    'public/js/bower_components/sweetalert/dist/sweetalert.min.js',
    'public/js/bower_components/notifyjs/dist/notify.js',
    'public/js/bower_components/gsap/src/minified/TweenMax.min.js',
    'public/js/bower_components/pnotify/dist/pnotify.js',
    'public/js/bower_components/morris.js/morris.min.js',
    'public/js/bower_components/bootstrap-progressbar/bootstrap-progressbar.js',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js',
    'public/js/bower_components/air-datepicker-master/dist/js/datepicker.js',
    'public/js/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.js',
    'public/js/bower_components/masonry/dist/masonry.pkgd.js',
    'public/js/bower_components/chosen/chosen.jquery.js',
    'public/js/bower_components/iodash/lodash.js',
], 'public/themes/auth/build/js/plugins.js');

mix.scripts([
    'public/themes/auth/js/bootstrap.min.js',
    //'public/js/bower_components/pacejs/pace.js',
    'public/themes/auth/js/custom.min.js',
    'public/themes/auth/js/nprogress.js',
], 'public/themes/auth/build/js/core.js');