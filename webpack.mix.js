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
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/settings.scss', 'public/css')
    .sass('resources/sass/activities.scss', 'public/css')
    // .sass('resources/sass/processes.scss', 'public/css')
    .sass('resources/sass/files.scss', 'public/css')
    .sass('resources/sass/admin/files.scss', 'public/css/admin.files.css')

    .js('resources/js/page/settings/photo.js', 'public/js/page.settings.photo.js')

    .js('resources/js/page/admin/processes/show.js', 'public/js/page.admin.processes.show.js')

    .js('resources/js/page/admin/processes/tasks/index.js', 'public/js/page.admin.processes.tasks.index.js')
    .js('resources/js/page/admin/processes/tasks/show.js', 'public/js/page.admin.processes.tasks.show.js')

    .js('resources/js/page/admin/processes/tasks/actions/index.js', 'public/js/page.admin.processes.tasks.actions.index.js')


    .js('resources/js/page/admin/file-types/forms/index.js', 'public/js/page.admin.file-types.forms.index.js')
    .js('resources/js/page/admin/file-types/forms/show.js', 'public/js/page.admin.file-types.forms.show.js')
    .js('resources/js/page/admin/file-types/forms/fields/index.js', 'public/js/page.admin.file-types.forms.fields.index.js')
    .js('resources/js/page/admin/file-types/forms/fields/_form.js', 'public/js/page.admin.file-types.forms.fields._form.js')

    .js('resources/js/page/admin/file-types/panels/show.js', 'public/js/page.admin.file-types.panels.show.js')


    .js('resources/js/page/files/index.js', 'public/js/page.files.index.js')
    .js('resources/js/page/files/_form.js', 'public/js/page.files._form.js')


    .js('resources/js/page/activities/tasks/_form.js', 'public/js/page.activities.tasks._form.js')

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
        'trix',
        'sortablejs'
    ])
;

mix.disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            Services : path.resolve(__dirname, "resources/js/services"),
            Component: path.resolve(__dirname, "resources/js/component"),
            App      : path.resolve(__dirname, "resources/js/app"),
            // Css      : path.resolve(__dirname, "resources/sass"),
            // Modules  : path.resolve(__dirname, "node_modules")
            // NodeModules  : path.resolve(__dirname, 'node_modules')
        }
    }
});
