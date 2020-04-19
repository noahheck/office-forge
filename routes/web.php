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


    Route::resource('/activities', 'ActivityController');
    Route::post('activities/{activity}/complete', 'ActivityController@complete')->name('activities.complete');
    Route::post('activities/{activity}/uncomplete', 'ActivityController@uncomplete')->name('activities.uncomplete');

    Route::namespace('Activity')->prefix('/activities/{activity}')->name('activities.')->group(function() {


        Route::resource('/tasks', 'TaskController');

        Route::get('/participants', 'ParticipantController@show')->name('participants.index');
        Route::get('/participants/edit', 'ParticipantController@edit')->name('participants.edit');
        Route::post('/participants', 'ParticipantController@update')->name('participants.update');

    });


    Route::resource('/files', 'FileController');
    Route::namespace('File')->prefix('/files/{file}')->name('files.')->middleware('can:view,file')->group(function() {

        Route::get('/forms', 'FormController@index')->name('forms.index');
        Route::get('/forms/{form}', 'FormController@show')->name('forms.show');
        Route::put('/forms/{form}', 'FormController@update')->name('forms.update');

    });

    Route::namespace('Settings')->prefix('/settings')->name('my-settings.')->group(function() {

        Route::get('/', 'SettingsController@index')->name('index');
        Route::post('/', 'SettingsController@update')->name('update');

        Route::get('/password', 'PasswordController@index')->name('password');
        Route::post('/password', 'PasswordController@update')->name('password.update');

        Route::get('/photo', 'PhotoController@index')->name('photo');
        Route::post('/photo', 'PhotoController@update')->name('photo.update');

        Route::get('/teams', 'TeamsController@index')->name('teams');

    });


    Route::middleware(['user.admin'])->namespace('Admin')->prefix('/admin')->name('admin.')->group(function() {

        Route::get('/', 'AdminController@index')->name('index');

        Route::resource('/users', 'UserController');

        Route::resource('/teams', 'TeamController');

        Route::get('/organization', 'OrganizationController@index')->name('organization');
        Route::post('/organization', 'OrganizationController@update')->name('organization.update');

        Route::resource('/file-types', 'FileTypeController');
        Route::resource('file-types.forms', 'FileType\FormController');
        Route::post('/file-types/{fileType}/forms/update-order', 'FileType\FormController@updateOrder')
            ->name('file-types.forms.update-order');


        Route::resource('file-types.forms.fields', 'FileType\Form\FieldController');
        Route::post('/file-types/{fileType}/forms/{form}/fields/update-order', 'FileType\Form\FieldController@updateOrder')
            ->name('file-types.forms.fields.update-order');


        Route::resource('file-types.panels', 'FileType\PanelController');
        Route::post('/file-types/{fileType}/panels/{panel}/add-field', 'FileType\PanelController@addField')
            ->name('file-types.panels.add-field');
        Route::delete('/file-types/{fileType}/panels/{panel}/fields/{field}', 'FileType\PanelController@removeField')
            ->name('file-types.panels.remove-field');
        Route::post('/file-types/{fileType}/panels/{panel}/update-field-order', 'FileType\PanelController@updateFieldOrder')
            ->name('file-types.panels.update-field-order');


        Route::resource('/processes', 'ProcessController');

        Route::namespace('Process')->prefix('/processes/{process}')->name('processes.')->group(function() {

            Route::resource('/tasks', 'TaskController');
            Route::post('/tasks/update-order', 'TaskController@updateOrder')->name('tasks.update-order');

        });
    });

});
