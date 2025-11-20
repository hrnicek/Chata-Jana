<?php

use App\Http\Controllers\Api\Booking\CalendarController;
use App\Http\Controllers\Api\Booking\StoreBookingController;
use App\Http\Controllers\Api\Booking\VerifyAvailabilityController;
use App\Http\Controllers\Api\Service\CheckServiceAvailabilityController;
use App\Http\Controllers\Api\Service\ListServicesController;
use Illuminate\Support\Facades\Route;

Route::get('bookings/calendar', [CalendarController::class, 'index'])->name('api.bookings.calendar');
Route::post('bookings', StoreBookingController::class)->name('api.bookings.store');
Route::post('bookings/verify', VerifyAvailabilityController::class)->name('api.bookings.verify');

// New service routes
Route::get('services', ListServicesController::class)->name('api.services.index');
Route::post('services/availability', CheckServiceAvailabilityController::class)->name('api.services.availability');

// Backward compatible aliases for extras
Route::get('extras', ListServicesController::class)->name('api.extras.index');
Route::post('extras/availability', CheckServiceAvailabilityController::class)->name('api.extras.availability');
