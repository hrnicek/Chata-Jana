<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/kontakt', [\App\Http\Controllers\ContactsController::class, 'index'])->name('contact');
Route::get('/cenik', [\App\Http\Controllers\PricingController::class, 'index'])->name('pricing');
Route::get('/rezervace', [BookingController::class, 'calendar'])->name('bookings.calendar');
Route::get('/o-nas', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/aktivity', [\App\Http\Controllers\ActivitiesController::class, 'index'])->name('activities');
Route::get('/fotogalerie', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');
