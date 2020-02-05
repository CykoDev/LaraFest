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

Route::get('/media/delete/{filepath}', ['as'=>'delete', 'uses'=>'MediaController@delete']);
Route::get('/media/download/{filepath}', ['as'=>'download', 'uses'=>'MediaController@download']);

Route::group(['middleware'=>'verified'], function(){

    Route::resource('users', 'UserController');
    Route::get('/users-role/{role}', ['as'=>'users.index-role', 'uses'=>'UserController@indexRole']);

    Route::resource('roles', 'RoleController');

    Route::resource('events', 'EventController');

    Route::resource('media', 'MediaController');
    Route::post('media/bulk-manage', ['as'=>'media.manageMany', 'uses'=>'MediaController@manageMany']);

    Route::post('export/users', 'UserController@exportAllUsers');
    Route::post('export/applicants', 'UserController@exportApplicants');
    Route::post('export/admins', 'UserController@exportAdmins');
    Route::post('export/monitors', 'UserController@exportMonitors');
    Route::post('export/moderators', 'UserController@exportModerators');
});

// test routes

Route::get('pdf/download', 'UserController@generatepdf');
