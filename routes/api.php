<?php

use App\Http\Controllers\Api\Booking\CalendarController;
use Illuminate\Support\Facades\Route;

Route::get('bookings/calendar', [CalendarController::class, 'index'])->name('api.bookings.calendar');
