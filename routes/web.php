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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::get('/logout', 'Auth\LoginController@logout');


Route::middleware(['auth', 'user.active'])->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::namespace('Settings')->prefix('/settings')->name('my-settings.')->group(function() {

        Route::get('/', 'SettingsController@index')->name('index');
        Route::post('/', 'SettingsController@update')->name('update');

        Route::get('/password', 'PasswordController@index')->name('password');
        Route::post('/password', 'PasswordController@update')->name('password.update');
    });


    Route::middleware(['user.admin'])->namespace('Admin')->prefix('/admin')->name('admin.')->group(function() {

        Route::get('/', 'AdminController@index')->name('index');

        Route::resource('/users', 'UserController');//->name('users');

    });

});
