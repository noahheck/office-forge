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

mix
    .version()
    // Help manual
    .sass('resources/sass/manual.scss', 'public/css')

    // Authentication pages
    .sass('resources/sass/auth.scss', 'public/css')

    // App
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/document.scss', 'public/css')

    // Home
    .sass('resources/sass/home.scss', 'public/css')

    // FileStore
    .sass('resources/sass/fileStore.scss', 'public/css')
    .js('resources/js/page/drives/files/_form.js', 'public/js/page.drives.files._form.js')
    // .js('resources/js/page/drives/files/show.js', 'public/js/page.drives.files.show.js')

    // FormDocs
    .js('resources/js/page/form-docs/index.js', 'public/js/page.form-docs.index.js')

    // User Activity
    .sass('resources/sass/user-activity.scss', 'public/css')
    .js('resources/js/page/user-activity.js', 'public/js/page.user-activity.js')

    // My settings
    .sass('resources/sass/settings.scss', 'public/css')
    .js('resources/js/page/settings/photo.js', 'public/js/page.settings.photo.js')

    // Activities
    .sass('resources/sass/activities.scss', 'public/css')
    .js('resources/js/page/activities/show.js', 'public/js/page.activities.show.js')
    .js('resources/js/page/activities/_tasklist.js', 'public/js/page.activities._tasklist.js')
    .js('resources/js/page/activities/tasks/_form.js', 'public/js/page.activities.tasks._form.js')

    // Files
    .sass('resources/sass/files.scss', 'public/css')
    .js('resources/js/page/files/index.js', 'public/js/page.files.index.js')
    .js('resources/js/page/files/_form.js', 'public/js/page.files._form.js')

    // FormDocs
    .sass('resources/sass/formDocs.scss', 'public/css')
    .js('resources/js/page/admin/form-docs/show.js', 'public/js/page.admin.form-docs.show.js')
    .js('resources/js/page/admin/form-docs/fields/index.js', 'public/js/page.admin.form-docs.fields.index.js')

    // Admin
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/admin/server.scss', 'public/css/admin.server.css')
    .sass('resources/sass/admin/files.scss', 'public/css/admin.files.css')
    .sass('resources/sass/admin/_field.scss', 'public/css/admin._field.css')
        // Processes
        .js('resources/js/page/admin/processes/show.js', 'public/js/page.admin.processes.show.js')
        .js('resources/js/page/admin/processes/tasks/index.js', 'public/js/page.admin.processes.tasks.index.js')
        .js('resources/js/page/admin/processes/tasks/show.js', 'public/js/page.admin.processes.tasks.show.js')
        .js('resources/js/page/admin/processes/tasks/actions/index.js', 'public/js/page.admin.processes.tasks.actions.index.js')

        // Files
        .js('resources/js/page/admin/file-types/forms/index.js', 'public/js/page.admin.file-types.forms.index.js')
        .js('resources/js/page/admin/file-types/forms/show.js', 'public/js/page.admin.file-types.forms.show.js')
        .js('resources/js/page/admin/file-types/forms/fields/index.js', 'public/js/page.admin.file-types.forms.fields.index.js')
        .js('resources/js/page/admin/file-types/forms/fields/_form.js', 'public/js/page.admin.file-types.forms.fields._form.js')

        // Panels
        .js('resources/js/page/admin/file-types/panels/index.js', 'public/js/page.admin.file-types.panels.index.js')
        .js('resources/js/page/admin/file-types/panels/show.js', 'public/js/page.admin.file-types.panels.show.js')

        //Reports

        //Datasets
        .js('resources/js/page/admin/reports/datasets/_form.js', 'public/js/page.admin.reports.datasets._form.js')

        //Datasets/Fields
        .js('resources/js/page/admin/reports/datasets/fields/_form.js', 'public/js/page.admin.reports.datasets.fields._form.js')

        //Datasets/Filters
        .js('resources/js/page/admin/reports/datasets/filters/_form.js', 'public/js/page.admin.reports.datasets.filters._form.js')




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
