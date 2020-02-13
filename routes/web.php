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

    Route::namespace('Settings')->prefix('/settings')->name('my-settings.')->group(function() {

        Route::get('/', 'SettingsController@index')->name('index');
        Route::post('/', 'SettingsController@update')->name('update');

        Route::get('/password', 'PasswordController@index')->name('password');
        Route::post('/password', 'PasswordController@update')->name('password.update');

        Route::get('/photo', 'PhotoController@index')->name('photo');
        Route::post('/photo', 'PhotoController@update')->name('photo.update');

        Route::get('/teams', 'TeamsController@index')->name('teams');

    });


    Route::resource('/projects', 'ProjectController');

    Route::namespace('Project')->prefix('/projects/{project}')->name('projects.')->group(function() {

        Route::resource('/tasks', 'TaskController');

    });

    Route::resource('/processes', 'Process\InstanceController')
        ->parameter('processes','instance');

    Route::resource('processes.tasks', 'Process\Instance\TaskController')
        ->except(['create', 'store'])
        ->parameter('processes', 'instance');

    Route::resource('processes.tasks.actions', 'Process\Instance\Task\ActionController')
        ->parameter('processes', 'instance');



    Route::middleware(['user.admin'])->namespace('Admin')->prefix('/admin')->name('admin.')->group(function() {

        Route::get('/', 'AdminController@index')->name('index');

        Route::resource('/users', 'UserController');

        Route::resource('/teams', 'TeamController');

        Route::get('/organization', 'OrganizationController@index')->name('organization');
        Route::post('/organization', 'OrganizationController@update')->name('organization.update');

        Route::resource('/file-types', 'FileTypeController');

        Route::resource('/processes', 'ProcessController');

        Route::namespace('Process')->prefix('/processes/{process}')->name('processes.')->group(function() {

            Route::resource('/tasks', 'TaskController');
            Route::post('/tasks/update-order', 'TaskController@updateOrder')->name('tasks.update-order');

            Route::namespace('Task')->prefix('/tasks/{task}')->name('tasks.')->group(function() {

                Route::resource('/actions', 'ActionController');
                Route::post('/actions/update-order', 'ActionController@updateOrder')->name('actions.update-order');

            });

        });
    });

});
