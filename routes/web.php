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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('users', 'UserController@index')->name('users');
Route::post('users', 'UserController@show')->name('users');
Route::get('users/create', 'UserController@createUser');
Route::post('users/create', 'UserController@saveUser');

//User Role
Route::get('roles', 'UserRoleController@index');
Route::post('roles', 'UserRoleController@processUserRole');
Route::get('roles/create', 'UserRoleController@createUserRole');
Route::post('roles/create', 'UserRoleController@saveUserRole');
Route::get('roles/edit/{id}', 'UserRoleController@editUserRole');
Route::post('roles/edit/{id}', 'UserRoleController@processEditUserRole');

//Modules
Route::get('modules', 'ModuleController@index');
Route::post('modules', 'ModuleController@processModule');
Route::get('modules/create', 'ModuleController@createModule');
Route::post('modules/create', 'ModuleController@saveModule');

// Email related routes
Route::get('mail/send', 'MailController@send');

//DropZone
Route::resource('dropZone', 'DropZoneController');