const mix = require('laravel-mix');


mix.js(['resources/js/app.js',
        'resources/js/js.js'], 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles('resources/sass/styles.css', 'public/css');
