<?php

use App\Http\Controllers\Api\Booking\CalendarController;
use App\Http\Controllers\Api\Booking\VerifyAvailabilityController;
use Illuminate\Support\Facades\Route;

Route::get('bookings/calendar', [CalendarController::class, 'index'])->name('api.bookings.calendar');
Route::post('bookings/verify', VerifyAvailabilityController::class)->name('api.bookings.verify');
