<?php

use App\Models\Booking;
use App\Models\BookingStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns available true for free range', function () {
    $payload = [
        'start_date' => '2025-11-01',
        'end_date' => '2025-11-03',
    ];

    $response = $this->postJson('/api/bookings/verify', $payload);

    $response->assertSuccessful();
    $response->assertJson([
        'available' => true,
    ]);
});

it('returns available false when range overlaps existing booking', function () {
    Booking::query()->create([
        'start_date' => '2025-11-10',
        'end_date' => '2025-11-12',
        'total_price' => 1000,
        'status' => BookingStatus::Confirmed,
    ]);

    $payload = [
        'start_date' => '2025-11-11',
        'end_date' => '2025-11-11',
    ];

    $response = $this->postJson('/api/bookings/verify', $payload);

    $response->assertSuccessful();
    $response->assertJson([
        'available' => false,
    ]);
    $this->assertNotEmpty($response->json('unavailable_dates'));
});
