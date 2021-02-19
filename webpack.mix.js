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

const ofPath = "public/" + process.env.APP_ENV;

mix
    .version()
    // Help manual
    .sass('resources/sass/manual.scss', ofPath + '/css')

    // Authentication pages
    .sass('resources/sass/auth.scss', ofPath + '/css')

    // App
    .js('resources/js/app.js', ofPath + '/js')
    .sass('resources/sass/app.scss', ofPath + '/css')
    .sass('resources/sass/document.scss', ofPath + '/css')

    // Home
    .sass('resources/sass/home.scss', ofPath + '/css')

    // FileStore
    .sass('resources/sass/fileStore.scss', ofPath + '/css')
    .js('resources/js/page/drives/files/_form.js', ofPath + '/js/page.drives.files._form.js')
    // .js('resources/js/page/drives/files/show.js', ofPath + '/js/page.drives.files.show.js')

    // FormDocs
    .js('resources/js/page/form-docs/index.js', ofPath + '/js/page.form-docs.index.js')

    // User Activity
    .sass('resources/sass/user-activity.scss', ofPath + '/css')
    .js('resources/js/page/user-activity.js', ofPath + '/js/page.user-activity.js')

    // My settings
    .sass('resources/sass/settings.scss', ofPath + '/css')
    .js('resources/js/page/settings/photo.js', ofPath + '/js/page.settings.photo.js')

    // Activities
    .sass('resources/sass/activities.scss', ofPath + '/css')
    .js('resources/js/page/activities/show.js', ofPath + '/js/page.activities.show.js')
    .js('resources/js/page/activities/_tasklist.js', ofPath + '/js/page.activities._tasklist.js')
    .js('resources/js/page/activities/tasks/_form.js', ofPath + '/js/page.activities.tasks._form.js')

    // Files
    .sass('resources/sass/files.scss', ofPath + '/css')
    .js('resources/js/page/files/index.js', ofPath + '/js/page.files.index.js')
    .js('resources/js/page/files/_form.js', ofPath + '/js/page.files._form.js')

    // FormDocs
    .sass('resources/sass/formDocs.scss', ofPath + '/css')
    .js('resources/js/page/admin/form-docs/show.js', ofPath + '/js/page.admin.form-docs.show.js')
    .js('resources/js/page/admin/form-docs/fields/index.js', ofPath + '/js/page.admin.form-docs.fields.index.js')

    // Reports
    .sass('resources/sass/reports.scss', ofPath + '/css')
    .js('resources/js/page/reports/_reports.js', ofPath + '/js/page._reports.js')

    // Admin
    .sass('resources/sass/admin.scss', ofPath + '/css')
    .sass('resources/sass/admin/server.scss', ofPath + '/css/admin.server.css')
    .sass('resources/sass/admin/files.scss', ofPath + '/css/admin.files.css')
    .sass('resources/sass/admin/_field.scss', ofPath + '/css/admin._field.css')
        // Processes
        .js('resources/js/page/admin/processes/show.js', ofPath + '/js/page.admin.processes.show.js')
        .js('resources/js/page/admin/processes/tasks/index.js', ofPath + '/js/page.admin.processes.tasks.index.js')
        .js('resources/js/page/admin/processes/tasks/show.js', ofPath + '/js/page.admin.processes.tasks.show.js')
        .js('resources/js/page/admin/processes/tasks/actions/index.js', ofPath + '/js/page.admin.processes.tasks.actions.index.js')

        // Files
        .js('resources/js/page/admin/file-types/forms/index.js', ofPath + '/js/page.admin.file-types.forms.index.js')
        .js('resources/js/page/admin/file-types/forms/show.js', ofPath + '/js/page.admin.file-types.forms.show.js')
        .js('resources/js/page/admin/file-types/forms/fields/index.js', ofPath + '/js/page.admin.file-types.forms.fields.index.js')
        .js('resources/js/page/admin/file-types/forms/fields/_form.js', ofPath + '/js/page.admin.file-types.forms.fields._form.js')

        // Panels
        .js('resources/js/page/admin/file-types/panels/index.js', ofPath + '/js/page.admin.file-types.panels.index.js')
        .js('resources/js/page/admin/file-types/panels/show.js', ofPath + '/js/page.admin.file-types.panels.show.js')

        //Reports
        .js('resources/js/page/admin/reports/show.js', ofPath + '/js/page.admin.reports.show.js')

        //Datasets
        .js('resources/js/page/admin/reports/datasets/show.js', ofPath + '/js/page.admin.reports.datasets.show.js')
        .js('resources/js/page/admin/reports/datasets/_form.js', ofPath + '/js/page.admin.reports.datasets._form.js')

        //Datasets/Fields
        .js('resources/js/page/admin/reports/datasets/fields/_form.js', ofPath + '/js/page.admin.reports.datasets.fields._form.js')

        //Datasets/Filters
        .js('resources/js/page/admin/reports/datasets/filters/_form.js', ofPath + '/js/page.admin.reports.datasets.filters._form.js')

        //Datasets/Visualizations
        .js('resources/js/page/admin/reports/datasets/visualizations/_form.js', ofPath + '/js/page.admin.reports.datasets.visualizations._form.js')





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
        'sortablejs',
        'chart.js'
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
