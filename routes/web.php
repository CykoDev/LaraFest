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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/page-one', function() { return view('public.page-one'); });



/*
|--------------------------------------------------------------------------
| Portal Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>'verified'], function(){

    Route::resource('users', 'UserController');
    Route::get('/users-role/{role}', ['as'=>'users.index-role', 'uses'=>'UserController@indexRole']);

    Route::resource('roles', 'RoleController');

    Route::resource('events', 'EventController');

    Route::resource('discounts', 'DiscountController');

    // Route::resource('profile', 'ProfileController');

    Route::resource('media', 'MediaController');
    Route::post('media/bulk-manage', ['as'=>'media.manageMany', 'uses'=>'MediaController@manageMany']);


    /*
    |--------------------------------------------------------------------------
    | Exports
    |--------------------------------------------------------------------------
    */

    Route::post('export/users', 'ExportController@exportAllUsers');
    Route::post('export/applicants', 'ExportController@exportApplicants');
    Route::post('export/admins', 'ExportController@exportAdmins');
    Route::post('export/monitors', 'ExportController@exportMonitors');
    Route::post('export/moderators', 'ExportController@exportModerators');
    Route::post('export/events', 'ExportController@exportEvents');
});

Route::post('profile/store', 'ProfileController@store');
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('profile/update', ['as'=>'profile.update', 'uses'=>'ProfileController@update']);

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/

Route::get('pdf/download', 'UserController@generatepdf');





