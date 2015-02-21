var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
 var paths = {
 	'jquery': './vendor/bower_components/jquery/',
 	'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/'
 }

elixir(function(mix) {
    mix.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
    .copy(paths.bootstrap + 'stylesheets/bootstrap/**', 'resources/assets/sass/bootstrap')
    .copy(paths.jquery + 'dist/jquery.js', 'public/js/vendor/jquery.js')
    .copy(paths.bootstrap + 'javascripts/bootstrap.js', 'public/js/vendor/bootstrap.js')
    .sass('main.scss');
});

