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

// only move files to public for now; minify later
elixir(function(mix) {
    mix.sass('main.scss');
    mix.sass('admin.scss');
    mix.scripts(['vendor/jquery.js', 'vendor/uikit/uikit.js'], 'public/js/vendor.js');
    mix.scripts([
        "admin/codemirror/codemirror.js",
        "admin/codemirror/mode/markdown.js",
        "admin/codemirror/mode/xml.js",
        "admin/codemirror/mode/gfm.js",
        "admin/codemirror/addon/overlay.js",
        "admin/marked.js",
        "vendor/uikit/components/htmleditor.js"
    ], 'public/js/admin.js');
});

