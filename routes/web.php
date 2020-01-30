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

Auth::routes(['verify' => true]);

Route::get('/admin', function(){

    return view('layouts.admin');
})->name('dashboard');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/admin', function(){

    return view('layouts.admin');
})->name('dashboard');

Route::resource('admin/users', 'UserController');

Route::resource('media', 'MediaController');

Route::resource('roles', 'RoleController');

Route::get('users/export/', 'UserController@exportAllUsers');
