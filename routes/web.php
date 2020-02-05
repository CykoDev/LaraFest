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

Route::get('/home/admin', 'HomeController@adminUser')->name('admin.home');
Route::get('/home/applicant', 'HomeController@getApplicant')->name('applicant.home');
Route::get('/home/moderator', 'HomeController@moderator')->name('moderator.home');
Route::get('/home/monitor', 'HomeController@monitor')->name('monitor.home');

Route::post('/home/applicant', 'HomeController@postApplicant')->name('applicant.post');

Route::get('/admin', function(){

    return view('layouts.admin');
})->name('dashboard');

Route::resource('admin/users', 'UserController');

Route::resource('media', 'MediaController');

Route::resource('roles', 'RoleController');
