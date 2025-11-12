<?php

use App\Http\Controllers\Api\Booking\CalendarController;
use App\Http\Controllers\Api\Booking\StoreBookingController;
use App\Http\Controllers\Api\Booking\VerifyAvailabilityController;
use App\Http\Controllers\Api\Extra\CheckAvailabilityController;
use App\Http\Controllers\Api\Extra\ListExtrasController;
use Illuminate\Support\Facades\Route;

Route::get('bookings/calendar', [CalendarController::class, 'index'])->name('api.bookings.calendar');
Route::post('bookings', StoreBookingController::class)->name('api.bookings.store');
Route::post('bookings/verify', VerifyAvailabilityController::class)->name('api.bookings.verify');
Route::get('extras', ListExtrasController::class)->name('api.extras.index');
Route::post('extras/availability', CheckAvailabilityController::class)->name('api.extras.availability');
