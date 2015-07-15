var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('admin.scss');
    mix.sass('app.scss');
    mix.scripts([
    	'../../assets/bower/jquery/dist/jquery.js',
    	'../../assets/bower/bootstrap-sass-official/assets/javascripts/bootstrap.js'
    ], 'public/js/vendor.js');
});
