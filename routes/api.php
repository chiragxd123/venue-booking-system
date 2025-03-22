<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')->namespace('App\Http\Controllers\Api')->group(function () {

    // Venue Routes
    Route::get('venues', 'VenueController@index')->name('venues.index');
    Route::get('venues/{id}', 'VenueController@show')->name('venues.show');
    Route::post('venues', 'VenueController@store')->name('venues.store');
    Route::put('venues/{id}', 'VenueController@update')->name('venues.update');
    Route::delete('venues/{id}', 'VenueController@destroy')->name('venues.destroy');

    // Booking Routes
    Route::get('bookings', 'BookingController@index')->name('bookings.index');
    Route::get('bookings/{id}', 'BookingController@show')->name('bookings.show');
    Route::post('bookings', 'BookingController@store')->name('bookings.store');
    Route::put('bookings/{id}', 'BookingController@update')->name('bookings.update');
    Route::delete('bookings/{id}', 'BookingController@destroy')->name('bookings.destroy');

    // Availability Routes
    Route::get('availabilities', 'AvailabilityController@index')->name('availabilities.index');
    Route::post('availabilities', 'AvailabilityController@store')->name('availabilities.store');
    Route::delete('availabilities/{id}', 'AvailabilityController@destroy')->name('availabilities.destroy');

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });