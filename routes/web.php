<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('public.page-one');
})->name('home');

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

Route::get('/enroll/package/{id}', ['as' => 'enroll.package', 'uses' => 'ApplicantController@enrollPackage']);
Route::post('/enroll/package', ['as' => 'enroll.package.store', 'uses' => 'ApplicantController@storePackage']);

Route::get('/enroll/event/{id}', ['as' => 'enroll.event', 'uses' => 'ApplicantController@enrollEvent']);
Route::post('/enroll/event', ['as' => 'enroll.event.store', 'uses' => 'ApplicantController@storeEvent']);

Route::get('/invoice/print', ['as' => 'invoice.print', 'uses' => 'InvoiceController@generatepdf']);
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Route::get('/page-one', function() { return view('public.page-one'); });


/*
|--------------------------------------------------------------------------
| Portal Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'verified'], function () {

    Route::resource('users', 'UserController');
    Route::get('/users-role/{role}', ['as' => 'users.index-role', 'uses' => 'UserController@indexRole']);

    Route::resource('roles', 'RoleController');

    Route::resource('events', 'EventController');
    Route::resource('event/types', 'EventTypeController');
    Route::resource('events/discounts', 'EventsDiscountController');
    Route::get('events/discounts/create/{id}', ['as' => 'events.discounts.create', 'uses' => 'EventsDiscountController@create']);

    Route::resource('packages/discounts', 'PackagesDiscountController');
    Route::get('packages/discounts/create/{id}', ['as' => 'packages.discounts.create', 'uses' => 'PackagesDiscountController@create']);
    Route::resource('packages', 'PackageController');

    Route::get('/browse/events', ['as' => 'browse.events', 'uses' => 'EventController@indexBrowse']);
    Route::get('/browse/packages', ['as' => 'browse.packages', 'uses' => 'PackageController@indexBrowse']);

    Route::resource('media', 'MediaController');
    Route::post('media/bulk-manage', ['as' => 'media.manageMany', 'uses' => 'MediaController@manageMany']);
    Route::get('/media/delete/{filepath}', ['as' => 'delete', 'uses' => 'MediaController@delete']);
    Route::get('/media/download/{filepath}', ['as' => 'download', 'uses' => 'MediaController@download']);


    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */

    Route::get('profile', ['as' => 'profile.show', 'uses' => 'ProfileController@show']);
    Route::post('profile', ['as' => 'profile.store', 'uses' => 'ProfileController@store']);
    Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::patch('profile/edit/{route}', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::get('applicant/profile', ['as' => 'profile.applicant.edit', 'uses' => 'ProfileController@editApplicant']);
    Route::patch('applicant/profile/{route}', ['as' => 'profile.applicant.update', 'uses' => 'ProfileController@updateApplicant']);


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



/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/
