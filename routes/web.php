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



Auth::routes(['verify' => true]);

Route::get('/', function(){

    return view('welcome');
})->name('home');

Route::get('/dashboard', ['as'=>'dashboard', 'uses'=>'HomeController@index']);

Route::group(['middleware'=>'verified'], function(){

    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');

    Route::resource('media', 'MediaController');
    Route::post('media/bulk-delete', ['as'=>'media.destroyMany', 'uses'=>'MediaController@destroyMany']);
});

// test routes

Route::get('users/export/', 'UserController@exportAllUsers');

Route::get('pdf/download', 'UserController@generatepdf');
