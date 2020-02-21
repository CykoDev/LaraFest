<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes(['verify' => true]);


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('public.page-one');
})->name('home');


/*
|--------------------------------------------------------------------------
| Portal Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'verified'], function () {

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

    Route::get('/meet-the-creators', function () {
        return view('public.meet-the-creators');
    })->name('meet-the-creators');

    Route::resource('manage/users', 'UserController');
    Route::get('manage/users-role/{role}', ['as' => 'users.index-role', 'uses' => 'UserController@indexRole']);

    Route::resource('manage/user/roles', 'RoleController')->only('index');


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

    Route::get('manage/package-discounts/create/{id}', ['as' => 'packages.discounts.create', 'uses' => 'PackageController@createDiscount']);
    Route::post('manage/package-discounts', ['as' => 'packages.discounts.store', 'uses' => 'PackageController@storeDiscount']);
    Route::delete('manage/package-discounts/delete/{id}', ['as' => 'packages.discounts.delete', 'uses' => 'PackageController@destroyDiscount']);

    Route::get('packages/{slug}', ['as' => 'packages.view', 'uses' => 'PackageController@showView']);
    Route::post('packages/enroll/{route}', ['as' => 'packages.enroll', 'uses' => 'PackageController@enroll']);
    Route::post('packages/unenroll/{slug}', ['as' => 'packages.unenroll', 'uses' => 'PackageController@unEnroll']);
    Route::get('browse/packages', ['as' => 'packages.browse', 'uses' => 'PackageController@indexBrowse']);


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

    Route::get('manage/event-discounts/create/{id}', ['as' => 'events.discounts.create', 'uses' => 'EventController@createDiscount']);
    Route::post('manage/event-discounts', ['as' => 'events.discounts.store', 'uses' => 'EventController@storeDiscount']);
    Route::delete('manage/event-discounts/delete/{id}', ['as' => 'events.discounts.delete', 'uses' => 'EventController@destroyDiscount']);


    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */

    Route::get('profile', ['as' => 'profile.show', 'uses' => 'ProfileController@show']);
    Route::post('profile', ['as' => 'profile.store', 'uses' => 'ProfileController@store']);
    Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::patch('profile/edit/{route}', ['as' => 'profile.updateProfile', 'uses' => 'ProfileController@updateProfile']);
    Route::patch('profile-edit/{route}', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::get('applicant/profile', ['as' => 'profile.applicant.edit', 'uses' => 'ProfileController@editApplicant']);
    Route::patch('applicant/profile/{route}', ['as' => 'profile.applicant.update', 'uses' => 'ProfileController@updateApplicant']);
    Route::post('profile/reset', ['as' => 'profile.reset', 'uses' => 'ProfileController@resetProfile']);


    /*
    |--------------------------------------------------------------------------
    | Expense Routes
    |--------------------------------------------------------------------------
    */

    Route::get('enrolled-events', ['as' => 'enrolled.events', 'uses' => 'FinanceController@enrolledEvents']);
    Route::get('expenses-summary', ['as' => 'expenses.summary', 'uses' => 'FinanceController@expensesSummary']);
    Route::get('payment-status', ['as' => 'payment.status', 'uses' => 'FinanceController@paymentStatus']);
    Route::post('generate-invoice', ['as' => 'generate.invoice', 'uses' => 'FinanceController@generateInvoice']);
    Route::post('payment-status', ['as' => 'upload.proof', 'uses' => 'FinanceController@uploadProof']);
    Route::post('verify-users-payment', ['as' => 'verify.users.payment', 'uses' => 'FinanceController@verifyUsersPayment']);
    Route::get('verify-payment/{id}', ['as' => 'verify.payment', 'uses' => 'FinanceController@verifyUserPayment']);
    Route::get('unverify-payment/{id}', ['as' => 'unverify.payment', 'uses' => 'FinanceController@unverifyUserPayment']);


    /*
    |--------------------------------------------------------------------------
    | Exports
    |--------------------------------------------------------------------------
    */

    Route::post('export/users', 'ExportController@exportAllUsers');
    Route::post('export/users-role/{role}', 'ExportController@exportRoleUsers');
    Route::post('export/user-events/{id}', 'ExportController@exportUserEvents');
    Route::post('export/applicants', 'ExportController@exportApplicants');
    Route::post('export/admins', 'ExportController@exportAdmins');
    Route::post('export/monitors', 'ExportController@exportMonitors');
    Route::post('export/moderators', 'ExportController@exportModerators');
    Route::post('export/events', 'ExportController@exportEvents');
    Route::post('export/event-applicants/{id}', 'ExportController@exportEventApplicants');
    Route::post('export/packages', 'ExportController@exportPackages');
    Route::post('export/packages-applicants/{id}', 'ExportController@exportPackageApplicants');
});



/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/
