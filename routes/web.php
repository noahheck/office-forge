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

Auth::routes(['register' => false]);

Route::get('/logout', 'Auth\LoginController@logout');

Route::middleware(['auth', 'user.active'])->group(function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/notifications', 'NotificationsController@index')->name('notifications');

    Route::get('/headshot/{headshot}/{size}/{filename}', 'HeadShotController@photo')->name('headshot');

    Route::post('/editor-images', 'EditorImageController@upload')->name('editor-images.upload');
    Route::get('/editor-images/{editorImage}', 'EditorImageController@show')->name('editor-images.show');


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
    Route::namespace('File')->prefix('/files/{file}')->name('files.')->middleware('can:view,file')->group(function() {

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

        Route::namespace('Process')->prefix('/processes/{process}')->name('processes.')->group(function() {

            // Tasks
            Route::resource('/tasks', 'TaskController');
            Route::post('/tasks/update-order', 'TaskController@updateOrder')->name('tasks.update-order');

        });
    });

});
