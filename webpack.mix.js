const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/responsize.scss', 'public/css')
    .sass('resources/scss/responsize-admin.scss', 'public/css');