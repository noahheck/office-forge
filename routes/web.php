<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/logout', 'Auth\LoginController@logout');

Route::middleware(['server.not-setup'])->group(function() {
    Route::get('/setup', 'Server\SetupController@index')->name('server-setup');
    Route::post('/setup/key', 'Server\SetupController@key')->name('server-setup.key');

    Route::get('/setup/organization', 'Server\SetupController@organization')->name('server-setup.organization');
    Route::post('/setup/organization', 'Server\SetupController@organizationSave')->name('server-setup.organization-save');

    Route::get('/setup/user', 'Server\SetupController@user')->name('server-setup.user');
    Route::post('/setup/user', 'Server\SetupController@userSave')->name('server-setup.user-save');

    Route::get('/setup/completed', 'Server\SetupController@completed')->name('server-setup.completed');
});

Route::middleware(['server.setup'])->group(function() {
    Auth::routes(['register' => false]);
});

Route::middleware(['auth', 'user.active', 'server.setup'])->group(function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/notifications', 'NotificationsController@index')->name('notifications');

    Route::get('/headshot/{headshot}/{size}/{filename}', 'HeadShotController@photo')->name('headshot');

    Route::post('/editor-images', 'EditorImageController@upload')->name('editor-images.upload');
    Route::get('/editor-images/{editorImage}', 'EditorImageController@show')->name('editor-images.show');

    // Resource files
    Route::post('/resource-files', 'ResourceFileController@uploadFiles')->name('resource-files.upload');
    Route::get('/resource-files/{resourceFile}/preview/{filename}', 'ResourceFileController@preview')->name('resource-files.preview');
    Route::get('/resource-files/{resourceFile}/download/{filename}', 'ResourceFileController@downloadFile')->name('resource-files.download');
    Route::delete('/resource-files/{resourceFile}', 'ResourceFileController@delete')->name('resource-files.delete');

    // Help Docs
    Route::get('/manual/{key?}', 'ManualController@index')->name('manual');

    // Activity reporting
    Route::get('/activity', 'UserActivityController@index')->name('user-activity');


    // FileStore
    Route::get('/drives', 'DriveController@index')->name('drives.index');
    Route::get('/drives/{drive}', 'DriveController@show')->name('drives.show');
    Route::post('/drives/{drive}/upload-files', 'DriveController@uploadFiles')->name('drives.upload-files');

    Route::prefix('/drives/{drive}')->namespace('Drive')->name('drives.')->group(function() {

        Route::resource('/folders', 'FolderController');

        Route::resource('/files', 'MediaFileController');

        Route::get('/files/{file}/all-versions', 'MediaFileController@allVersions')->name('files.all-versions');
        Route::get('/files/{file}/new-version', 'MediaFileController@newVersion')->name('files.new-version');
        Route::put('/files/{file}/new-version', 'MediaFileController@uploadNewVersion')->name('files.upload-new-version');

        Route::get('/files/{file}/preview/{filename}', 'MediaFileController@preview')->name('files.preview');
        Route::get('/files/{file}/download/{filename}', 'MediaFileController@downloadFile')->name('files.download');

        Route::get('/files/{file}/preview/{version}/{filename}', 'MediaFileController@previewVersion')->name('files.preview-version');
        Route::get('/files/{file}/download/{version}/{filename}', 'MediaFileController@downloadVersion')->name('files.download-version');
    });


    // Activities
    Route::resource('/activities', 'ActivityController');
    Route::post('activities/{activity}/complete', 'ActivityController@complete')->name('activities.complete');
    Route::post('activities/{activity}/uncomplete', 'ActivityController@uncomplete')->name('activities.uncomplete');
    Route::post('activities/{activity}/update-tasks-order', 'ActivityController@updateTasksOrder')->name('activities.update-tasks-order');

    Route::namespace('Activity')->prefix('/activities/{activity}')->name('activities.')->group(function() {

        // Tasks
        Route::resource('/tasks', 'TaskController');
        Route::post('/tasks/{task}/complete', 'TaskController@complete')->name('tasks.complete');
        Route::post('/tasks/{task}/uncomplete', 'TaskController@uncomplete')->name('tasks.uncomplete');

        // Participants
        Route::get('/participants', 'ParticipantController@show')->name('participants.index');
        Route::get('/participants/edit', 'ParticipantController@edit')->name('participants.edit');
        Route::post('/participants', 'ParticipantController@update')->name('participants.update');
    });


    // FormDocs
    Route::resource('/form-docs', 'FormDocController');
    Route::post('/form-docs/download/spreadsheet', 'FormDocController@downloadSpreadsheet')->name('form-docs.download-spreadsheet');


    // Files
    Route::get('/files/search', 'FileController@search')->name('files.search');
    Route::resource('/files', 'FileController');
    Route::get('/files/{file}/access', 'FileController@access')->name('files.access');
    Route::namespace('File')->prefix('/files/{file}')->name('files.')->middleware('can:view,file')->group(function() {

        // Forms
        Route::get('/forms', 'FormController@index')->name('forms.index');
        Route::get('/forms/{form}', 'FormController@show')->name('forms.show');
        Route::put('/forms/{form}', 'FormController@update')->name('forms.update');

        // FileStore
        Route::get('/drives', 'DriveController@index')->name('drives.index');
        Route::get('/drives/{drive}', 'DriveController@show')->name('drives.show');
        Route::post('/drives/{drive}/upload-files', 'DriveController@uploadFiles')->name('drives.upload-files');

        Route::prefix('/drives/{drive}')->namespace('Drive')->name('drives.')->group(function() {

            Route::resource('/folders', 'FolderController');

            Route::resource('/mediaFiles', 'MediaFileController');

            Route::get('/mediaFiles/{mediaFile}/all-versions', 'MediaFileController@allVersions')->name('mediaFiles.all-versions');
            Route::get('/mediaFiles/{mediaFile}/new-version', 'MediaFileController@newVersion')->name('mediaFiles.new-version');
            Route::put('/mediaFiles/{mediaFile}/new-version', 'MediaFileController@uploadNewVersion')->name('mediaFiles.upload-new-version');

            Route::get('/mediaFiles/{mediaFile}/preview/{filename}', 'MediaFileController@preview')->name('mediaFiles.preview');
            Route::get('/mediaFiles/{mediaFile}/download/{filename}', 'MediaFileController@downloadFile')->name('mediaFiles.download');

            Route::get('/mediaFiles/{mediaFile}/preview/{version}/{filename}', 'MediaFileController@previewVersion')->name('mediaFiles.preview-version');
            Route::get('/mediaFiles/{mediaFile}/download/{version}/{filename}', 'MediaFileController@downloadVersion')->name('mediaFiles.download-version');
        });

    });

    Route::post('/my-files/add/{file}', 'MyFilesController@addToMyFiles')->name('add-to-my-files');
    Route::post('/my-files/remove/{file}', 'MyFilesController@removeFromMyFiles')->name('remove-from-my-files');



    // My Settings
    Route::namespace('Settings')->prefix('/settings')->name('my-settings.')->group(function() {

        Route::get('/', 'SettingsController@index')->name('index');
        Route::post('/', 'SettingsController@update')->name('update');

        Route::get('/password', 'PasswordController@index')->name('password');
        Route::post('/password', 'PasswordController@update')->name('password.update');

        Route::get('/photo', 'PhotoController@index')->name('photo');
        Route::post('/photo', 'PhotoController@update')->name('photo.update');

        Route::get('/teams', 'TeamsController@index')->name('teams');

    });


    // Admin
    Route::middleware(['user.admin'])->namespace('Admin')->prefix('/admin')->name('admin.')->group(function() {

        Route::get('/', 'AdminController@index')->name('index');

        // Users
        Route::resource('/users', 'UserController');

        // Teams
        Route::resource('/teams', 'TeamController');

        // Organization
        Route::get('/organization', 'OrganizationController@index')->name('organization');
        Route::post('/organization', 'OrganizationController@update')->name('organization.update');

        // File Types
        Route::resource('/file-types', 'FileTypeController');

        // File Types Access Locks
        Route::resource('file-types.access-locks', 'FileType\AccessLockController');

        // File Types Forms
        Route::resource('file-types.forms', 'FileType\FormController');
        Route::post('/file-types/{fileType}/forms/update-order', 'FileType\FormController@updateOrder')
            ->name('file-types.forms.update-order');

        Route::resource('file-types.forms.fields', 'FileType\Form\FieldController');
        Route::post('/file-types/{fileType}/forms/{form}/fields/update-order', 'FileType\Form\FieldController@updateOrder')
            ->name('file-types.forms.fields.update-order');

        // File Types Panels
        Route::resource('file-types.panels', 'FileType\PanelController');
        Route::post('/file-types/{fileType}/panels/update-order', 'FileType\PanelController@updateOrder')
            ->name('file-types.panels.update-order');

        Route::post('/file-types/{fileType}/panels/{panel}/add-field', 'FileType\PanelController@addField')
            ->name('file-types.panels.add-field');
        Route::delete('/file-types/{fileType}/panels/{panel}/fields/{field}', 'FileType\PanelController@removeField')
            ->name('file-types.panels.remove-field');
        Route::post('/file-types/{fileType}/panels/{panel}/update-field-order', 'FileType\PanelController@updateFieldOrder')
            ->name('file-types.panels.update-field-order');


        // FormDocs
        Route::resource('form-docs', 'FormDocController');
        Route::resource('form-docs.fields', 'FormDoc\FieldController');
        Route::post('/form-docs/{formDoc}/fields/update-order', 'FormDoc\FieldController@updateOrder')
            ->name('form-docs.fields.update-order');

        // Processes
        Route::resource('/processes', 'ProcessController');
        Route::post('/processes/{process}/add-template', 'ProcessController@addTemplate')
            ->name('processes.add-template');
        Route::delete('/processes/{process}/remove-template', 'ProcessController@removeTemplate')
            ->name('processes.remove-template');

        Route::namespace('Process')->prefix('/processes/{process}')->name('processes.')->group(function() {

            // Tasks
            Route::resource('/tasks', 'TaskController');
            Route::post('/tasks/update-order', 'TaskController@updateOrder')->name('tasks.update-order');

        });


        // FileStore
        Route::resource('/drives', 'DriveController');


        // Server
        Route::get('/server', 'ServerController@index')->name('server');
        Route::get('/server/phpinfo', 'ServerController@phpinfo')->name('server.phpinfo');

        Route::get('/server/updates/settings', 'Server\UpdatesController@settings')->name('server.updates.settings');
        Route::post('/server/updates/settings', 'Server\UpdatesController@saveSettings')->name('server.updates.save-settings');

        Route::get('/server/updates/history', 'Server\UpdatesController@history')->name('server.updates.history');
        Route::get('/server/updates/history/{update}', 'Server\UpdatesController@update')->name('server.updates.history.update');


        // Backups
        Route::get('/backups', 'BackupsController@index')->name('backups');
        Route::get('/backups/settings', 'BackupsController@settings')->name('backups.settings');
        Route::post('/backups/settings', 'BackupsController@saveSettings')->name('backups.save-settings');
        Route::post('/backups/generate', 'BackupsController@generate')->name('backups.generate');
        Route::get('/backups/{backup}', 'BackupsController@show')->name('backups.show');
        Route::get('/backups/{backup}/download', 'BackupsController@downloadBackup')->name('backups.download');


        // Logs
        Route::get('/logs', 'LogsController@index')->name('logs');
        Route::get('/logs/{logFile}', 'LogsController@show')->name('logs.show');
    });

});
