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


    // Help Docs
    Route::get('/manual/{key?}', 'ManualController@index')->name('manual');

    // Activity reporting
    Route::get('/activity', 'UserActivityController@index')->name('user-activity');


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


    // Files
    Route::resource('/files', 'FileController');
    Route::get('/files/{file}/access', 'FileController@access')->name('files.access');
    Route::namespace('File')->prefix('/files/{file}')->name('files.')->middleware('can:view,file')->group(function() {

        // Access

        // Forms
        Route::get('/forms', 'FormController@index')->name('forms.index');
        Route::get('/forms/{form}', 'FormController@show')->name('forms.show');
        Route::put('/forms/{form}', 'FormController@update')->name('forms.update');

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
    });

});
