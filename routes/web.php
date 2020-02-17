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

// Route::get('/enroll/package/{id}', ['as' => 'enroll.package', 'uses' => 'ApplicantController@enrollPackage']);
// Route::post('/enroll/package', ['as' => 'enroll.package.store', 'uses' => 'ApplicantController@storePackage']);

// Route::get('/enroll/event/{id}', ['as' => 'enroll.event', 'uses' => 'ApplicantController@enrollEvent']);
// Route::post('/enroll/event', ['as' => 'enroll.event.store', 'uses' => 'ApplicantController@storeEvent']);


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

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

    Route::resource('manage/users', 'UserController');
    Route::get('manage/users-role/{role}', ['as' => 'users.index-role', 'uses' => 'UserController@indexRole']);

    Route::resource('manage/users/roles', 'RoleController')->only('index');


    /*
    |--------------------------------------------------------------------------
    | Media Routes
    |--------------------------------------------------------------------------
    */

    Route::resource('media', 'MediaController');
    Route::post('media/bulk-manage', ['as' => 'media.manageMany', 'uses' => 'MediaController@manageMany']);
    Route::get('media/delete/{filepath}', ['as' => 'delete', 'uses' => 'MediaController@delete']);
    Route::get('media/download/{filepath}', ['as' => 'download', 'uses' => 'MediaController@download']);

    /*
    |--------------------------------------------------------------------------
    | Package Routes
    |--------------------------------------------------------------------------
    */

    Route::resource('manage/packages', 'PackageController');

    Route::resource('manage/package-discounts', 'PackagesDiscountController')->except('create');
    Route::get('packages/discounts/create/{id}', ['as' => 'packages-discounts.create', 'uses' => 'PackagesDiscountController@create']);

    Route::get('packages/{slug}', ['as' => 'packages.view', 'uses' => 'PackageController@showView']);
    Route::post('packages/enroll/{slug}', ['as' => 'packages.enroll', 'uses' => 'PackageController@enroll']);
    Route::post('packages/unenroll/{slug}', ['as' => 'packages.unenroll', 'uses' => 'PackageController@unEnroll']);


    /*
    |--------------------------------------------------------------------------
    | Event Routes
    |--------------------------------------------------------------------------
    */

    Route::resource('manage/events', 'EventController');
    Route::get('browse/events', ['as' => 'events.browse', 'uses' => 'EventController@indexBrowse']);
    Route::get('events/{slug}', ['as' => 'events.view', 'uses' => 'EventController@showView']);
    Route::post('events/enroll/{slug}', ['as' => 'events.enroll', 'uses' => 'EventController@enroll']);
    Route::post('events/unenroll/{slug}', ['as' => 'events.unenroll', 'uses' => 'EventController@unEnroll']);


    Route::resource('manage/event/types', 'EventTypeController');
    Route::resource('manage/event-discounts', 'EventsDiscountController')->except('create');
    Route::get('manage/discounts/events/create/{id}', ['as' => 'events-discounts.create', 'uses' => 'EventsDiscountController@create']);


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

Route::get('/pdf', 'InvoiceController@generatepdf');
