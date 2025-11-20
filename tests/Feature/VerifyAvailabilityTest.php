<?php

use App\Models\Booking;
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
    $customer = \App\Models\Customer::create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '123456789',
    ]);

    Booking::query()->create([
        'customer_id' => $customer->id,
        'code' => '123456',
        'start_date' => '2025-11-10',
        'end_date' => '2025-11-12',
        'total_price' => 1000,
        'status' => 'confirmed',
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
