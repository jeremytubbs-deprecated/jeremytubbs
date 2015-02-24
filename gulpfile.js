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
	'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/',
	'jquery': './vendor/bower_components/jquery/',
	'codemirror': './vendor/bower_components/codemirror/',
	'commonmark': './vendor/bower_components/commonmark/',
	'angular': './vendor/bower_components/angular/',
	'ngCodemirror': './vendor/bower_components/angular-ui-codemirror/',
    'ngSelect': './vendor/bower_components/angular-selectize.js/'
}

// only move files to public for now; minify later
elixir(function(mix) {
    mix.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
    .copy(paths.bootstrap + 'stylesheets/bootstrap/**', 'resources/assets/sass/bootstrap')
    .copy(paths.bootstrap + 'javascripts/bootstrap.js', 'public/js/vendor/bootstrap.js')
    .copy(paths.jquery + 'dist/jquery.js', 'public/js/vendor/jquery.js')
    .copy(paths.codemirror + 'lib/codemirror.js', 'public/js/posts/codemirror.js')
    .copy(paths.codemirror + 'lib/codemirror.css', 'public/css/posts/codemirror.css')
    .copy(paths.commonmark + 'dist/commonmark.js', 'public/js/posts/commonmark.js')
    .copy(paths.angular + 'angular.js', 'public/js/angular/angular.js')
    .copy(paths.ngCodemirror + 'ui-codemirror.js', 'public/js/posts/ui-codemirror.js')
    .copy(paths.ngSelect + 'angular-selectize.js', 'public/js/posts/angular-selectize.js')
    .copy('./resources/assets/js/postsApp.js', 'public/js/apps/postsApp.js')
    .sass('main.scss');
});

