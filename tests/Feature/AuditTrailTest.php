<?php

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Activitylog\Models\Activity;

uses(RefreshDatabase::class);

it('logs booking creation', function () {
    $this->seed(\Database\Seeders\SeasonSeeder::class);

    $customer = Customer::create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '123456789',
    ]);

    $booking = Booking::create([
        'customer_id' => $customer->id,
        'code' => '123456',
        'start_date' => '2025-06-01',
        'end_date' => '2025-06-05',
        'total_price' => 5000,
        'status' => 'pending',
    ]);

    $this->assertDatabaseHas('activity_log', [
        'subject_type' => Booking::class,
        'subject_id' => $booking->id,
        'description' => 'created',
    ]);
});

it('logs status changes', function () {
    $this->seed(\Database\Seeders\SeasonSeeder::class);

    $customer = Customer::create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '123456789',
    ]);

    $booking = Booking::create([
        'customer_id' => $customer->id,
        'code' => '123456',
        'start_date' => '2025-06-01',
        'end_date' => '2025-06-05',
        'total_price' => 5000,
        'status' => 'pending',
    ]);

    $booking->status->transitionTo(\App\States\Booking\Confirmed::class);

    $this->assertDatabaseHas('activity_log', [
        'subject_type' => Booking::class,
        'subject_id' => $booking->id,
        'description' => 'updated',
    ]);

    $activity = Activity::where('subject_id', $booking->id)->where('description', 'updated')->first();
    expect($activity->properties['attributes']['status'])->toBe('confirmed');
    expect($activity->properties['old']['status'])->toBe('pending');
});
