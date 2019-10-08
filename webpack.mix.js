const mix = require('laravel-mix');


mix.js(['resources/js/app.js',
        'resources/js/js.js'],
        'public/js/app.js')
    // .sass('resources/sass/app.scss',
    //     'public/css/app.css')
    .styles('resources/css/style.css',
        'public/css/styles.css');

mix.disableNotifications();