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
    .js('resources/js/lecture/lecture-create.js','public/js/lecture')
    .js('resources/js/lecture/lecture-edit.js','public/js/lecture')
    .js('resources/js/lecture/lecture-index.js','public/js/lecture')
    .js('resources/js/lecture/lecture-show.js','public/js/lecture')
    .js('resources/js/interest/interest-index.js','public/js/interest')
    .js('resources/js/register/register-index.js','public/js/register')
    .js('resources/js/myinfo/myinfo-index.js','public/js/myinfo')
    .js('resources/js/pageview/pageview.js','public/js/pageview')
    .js('resources/js/board/board-show.js','public/js/board')
    .js('resources/js/admin/app.js','public/js/admin')
    .js('resources/js/admin/layout/index.js','public/js/admin/layout')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/lecture/lecture-create.scss', 'public/css/lecture')
    .sass('resources/sass/lecture/lecture-edit.scss', 'public/css/lecture')
    .sass('resources/sass/lecture/lecture-index.scss', 'public/css/lecture')
    .sass('resources/sass/lecture/lecture-show.scss','public/css/lecture')
    .sass('resources/sass/interest/interest-index.scss','public/css/interest')
    .sass('resources/sass/register/register-index.scss','public/css/register')
    .sass('resources/sass/myinfo/myinfo-index.scss','public/css/myinfo')
    .sass('resources/sass/inquire/inquire-index.scss','public/css/inquire')
    .sass('resources/sass/notice/notice-index.scss','public/css/notice')
    .sass('resources/sass/notice/notice-show.scss','public/css/notice')
    .sass('resources/sass/notice/notice-edit.scss','public/css/notice')
    .sass('resources/sass/notice/notice-create.scss','public/css/notice')
    .sass('resources/sass/board/board-index.scss','public/css/board')
    .sass('resources/sass/board/board-show.scss','public/css/board')
    .sass('resources/sass/board/board-edit.scss','public/css/board')
    .sass('resources/sass/board/board-create.scss','public/css/board')
    .sass('resources/sass/admin/admin-index.scss','public/css/admin')
    .sass('resources/sass/welcome/welcome.scss','public/css/welcome')
    .react()
    .sourceMaps();
