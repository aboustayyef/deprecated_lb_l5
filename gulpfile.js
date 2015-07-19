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
    mix.sass(['admin.scss','admin_additions.scss'],'public/css/admin.css');
    mix.sass('app.scss');
    mix.scripts([
		'../../assets/bower/jquery/dist/jquery.js',
		'../../assets/bower/bootstrap-sass-official/assets/javascripts/bootstrap.js'
    ], 'public/js/vendor.js');
    mix.scripts([
		'../../assets/javascript/admin/auto_fill_blog_info.js'
    ], 'public/js/admin.js');
});