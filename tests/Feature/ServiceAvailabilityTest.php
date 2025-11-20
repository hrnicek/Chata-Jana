<?php

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use App\Models\Customer;

it('lists active services', function () {
    Service::create(['name' => 'Pes', 'is_active' => true, 'price' => 100, 'price_type' => 'per_stay', 'max_quantity' => 5]);
    Service::create(['name' => 'Postýlka', 'is_active' => false, 'price' => 50, 'price_type' => 'per_stay', 'max_quantity' => 2]);

    $res = $this->getJson('/api/services');
    $res->assertSuccessful();

    $ids = collect($res->json('services'))->pluck('name');

    expect($ids)->toContain('Pes');
    expect($ids)->not->toContain('Postýlka');
});

it('checks availability and respects max quantity', function () {
    $service = Service::create([
        'name' => 'Postýlka',
        'price_type' => 'per_stay',
        'price' => 300,
        'max_quantity' => 2,
        'is_active' => true,
    ]);

    $customer = Customer::create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '123456789',
    ]);

    // Create a booking that uses 1 quantity
    $booking = Booking::create([
        'code' => '123456',
        'start_date' => '2024-01-01',
        'end_date' => '2024-01-05',
        'total_price' => 5000,
        'status' => 'confirmed',
        'customer_id' => $customer->id,
    ]);

    $booking->services()->attach($service->id, [
        'quantity' => 1,
        'price_total' => 300
    ]);

    // Check availability for same dates
    $res = $this->postJson('/api/services/availability', [
        'start_date' => '2024-01-01',
        'end_date' => '2024-01-05',
        'selections' => [
            ['service_id' => $service->id, 'quantity' => 2] // Requesting 2, but 1 is taken. Max is 2. So 1+2=3 > 2. Should fail.
        ]
    ]);

    // The controller returns available: false for that item
    $res->assertSuccessful();
    $data = $res->json();

    // Structure: { available: bool, items: [ { service_id, available, ... } ] }
    // Or maybe just list of items with status.
    // Let's check the controller response structure.
    // CheckServiceAvailabilityController returns:
    // [ 'available' => bool, 'items' => [ ... ] ]

    expect($data['available'])->toBeFalse();
    expect($data['items'][0]['is_available'])->toBeFalse();
    expect($data['items'][0]['service_id'])->toBe($service->id);
});
