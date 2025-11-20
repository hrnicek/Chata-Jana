<?php

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores booking with services and attaches pivot with totals', function () {
    $this->seed(\Database\Seeders\SeasonSeeder::class);
    $this->travelTo(now()->year . '-06-01');

    $perDay = Service::create([
        'name' => 'Pes',
        'price_type' => 'per_day',
        'price' => 300,
        'max_quantity' => 10,
        'is_active' => true,
    ]);

    $perStay = Service::create([
        'name' => 'Úklid',
        'price_type' => 'per_stay',
        'price' => 500,
        'max_quantity' => 1,
        'is_active' => true,
    ]);

    $data = [
        'start_date' => now()->addDays(10)->toDateString(),
        'end_date' => now()->addDays(12)->toDateString(), // 2 nights
        'customer' => [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ],
        'accommodation_total' => 11000, // Summer price 5500 * 2
        'addons' => [
            ['service_id' => $perDay->id, 'quantity' => 1], // 300 * 2 = 600
            ['service_id' => $perStay->id, 'quantity' => 1], // 500 * 1 = 500
        ],
        'addons_total' => 1100,
        'grand_total' => 12100,
    ];

    $response = $this->postJson(route('api.bookings.store'), $data);

    $response->assertCreated();

    $booking = Booking::latest('id')->first();

    expect($booking->services)->toHaveCount(2);

    $pes = $booking->services->firstWhere('name', 'Pes');
    expect($pes->pivot->price_total)->toEqual(600.0); // 300 * 2 nights * 1 qty

    $uklid = $booking->services->firstWhere('name', 'Úklid');
    expect($uklid->pivot->price_total)->toEqual(500.0); // 500 * 1 qty
});
