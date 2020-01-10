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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/settings.scss', 'public/css')
    .sass('resources/sass/projects.scss', 'public/css')

    .js('resources/js/page/settings/photo.js', 'public/js/page.settings.photo.js')

    .extract([
        'jquery',
        'popper.js',
        'bootstrap',
        'datatables.net',
        'datatables.net-buttons',
        'datatables.net-bs4',
        'lodash',
        'axios',
        'bootstrap-datepicker',
        'bootstrap-select',
        'trix'
    ])
;

mix.disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            Services : path.resolve(__dirname, "resources/js/services"),
            Component: path.resolve(__dirname, "resources/js/component"),
            // Css      : path.resolve(__dirname, "resources/sass"),
            // Modules  : path.resolve(__dirname, "node_modules")
            // NodeModules  : path.resolve(__dirname, 'node_modules')
        }
    }
});
