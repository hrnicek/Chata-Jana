<?php

use App\Models\Booking;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('validates minimum stay', function () {
    $season = Season::create([
        'name' => 'Test Season',
        'start_date' => '2025-06-01',
        'end_date' => '2025-06-30',
        'min_stay' => 3,
        'is_active' => true,
    ]);

    $data = [
        'start_date' => '2025-06-01',
        'end_date' => '2025-06-03', // 2 nights
        'customer' => [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ],
        'accommodation_total' => 1000,
    ];

    $response = $this->postJson(route('api.bookings.store'), $data);

    $response->assertStatus(422);
    $response->assertJsonFragment(['error' => 'Minimum stay for this period is 3 nights.']);
});

it('validates check-in day', function () {
    $season = Season::create([
        'name' => 'Test Season',
        'start_date' => '2025-07-01',
        'end_date' => '2025-07-31',
        'check_in_days' => ['Friday'],
        'is_active' => true,
    ]);

    // 2025-07-01 is Tuesday
    $data = [
        'start_date' => '2025-07-01',
        'end_date' => '2025-07-05',
        'customer' => [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ],
        'accommodation_total' => 1000,
    ];

    $response = $this->postJson(route('api.bookings.store'), $data);

    $response->assertStatus(422);
    $response->assertJsonFragment(['error' => 'Check-in is only allowed on: Friday.']);
});
