<?php


use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\HomeController;  

use App\Http\Controllers\Admin\RegistrationController;



Route::get('/', 'HomeController@index')->name('home');

// Registration
Route::post('/', 'HomeController@store')->name('register.create');




Route::get('speaker/{speaker}', 'HomeController@view')->name('speaker');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // Speakers
    Route::delete('speakers/destroy', 'SpeakersController@massDestroy')->name('speakers.massDestroy');
    Route::post('speakers/media', 'SpeakersController@storeMedia')->name('speakers.storeMedia');
    Route::resource('speakers', 'SpeakersController');

    // Schedules
    Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('schedules.massDestroy');
    Route::resource('schedules', 'ScheduleController');

    // Venues
    Route::delete('venues/destroy', 'VenuesController@massDestroy')->name('venues.massDestroy');
    Route::post('venues/media', 'VenuesController@storeMedia')->name('venues.storeMedia');
    Route::resource('venues', 'VenuesController');

    // Hotels
    Route::delete('hotels/destroy', 'HotelsController@massDestroy')->name('hotels.massDestroy');
    Route::post('hotels/media', 'HotelsController@storeMedia')->name('hotels.storeMedia');
    Route::resource('hotels', 'HotelsController');

    // Galleries
    Route::delete('galleries/destroy', 'GalleriesController@massDestroy')->name('galleries.massDestroy');
    Route::post('galleries/media', 'GalleriesController@storeMedia')->name('galleries.storeMedia');
    Route::resource('galleries', 'GalleriesController');

    // Sponsors
    Route::delete('sponsors/destroy', 'SponsorsController@massDestroy')->name('sponsors.massDestroy');
    Route::post('sponsors/media', 'SponsorsController@storeMedia')->name('sponsors.storeMedia');
    Route::resource('sponsors', 'SponsorsController');

    // Faqs
    Route::delete('faqs/destroy', 'FaqsController@massDestroy')->name('faqs.massDestroy');
    Route::resource('faqs', 'FaqsController');

    // Amenities
    Route::delete('amenities/destroy', 'AmenitiesController@massDestroy')->name('amenities.massDestroy');
    Route::resource('amenities', 'AmenitiesController');

    // Prices
    Route::delete('prices/destroy', 'PricesController@massDestroy')->name('prices.massDestroy');
    Route::resource('prices', 'PricesController');

    // Attendance
  
     // Create attendance
Route::get('attendance/create', 'AttendanceController@create')->name('attendance.create');
Route::post('attendance/store', 'AttendanceController@store')->name('attendance.store');

// Read attendance
Route::get('attendance', 'AttendanceController@index')->name('attendance.index');


// Update attendance
Route::get('attendance/edit/{id}', 'AttendanceController@edit')->name('attendance.edit');
Route::post('attendance/update/{id}', 'AttendanceController@update')->name('attendance.update');

// Delete attendance
Route::delete('attendance/delete/{id}', 'AttendanceController@delete')->name('attendance.delete');
// in routes/web.php

Route::get('attendance/download', 'AttendanceController@download')->name('attendance.download');

// upload  attendance

Route::post('attendance/import', 'AttendanceController@import')->name('attendance.import');


// Events

  // Create events
Route::get('events/create', 'EventsController@create')->name('events.create');
Route::post('events/store', 'EventsController@store')->name('events.store');

// Read events
Route::get('events', 'EventsController@index')->name('events.index');
Route::post('events/show/{id}', 'EventsController@show')->name('events.show');

// Update events
Route::get('events/edit/{id}', 'EventsController@edit')->name('events.edit');
Route::post('events/update/{id}', 'EventsController@update')->name('events.update');

// Delete events
Route::delete('events/delete/{id}', 'EventsController@delete')->name('events.delete');

// upload events
Route::post('events/import', 'EventsController@import')->name('events.import');


// Registration
Route::get('register', 'RegistrationController@index')->name('register.index');




});

 
