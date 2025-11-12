<?php

use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Extra;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists active extras', function () {
    Extra::factory()->create(['name' => 'Pes', 'is_active' => true]);
    Extra::factory()->create(['name' => 'Postýlka', 'is_active' => false]);

    $res = $this->getJson('/api/extras');
    $res->assertSuccessful();
    $ids = collect($res->json('extras'))->pluck('name');
    expect($ids)->toContain('Pes');
    expect($ids)->not->toContain('Postýlka');
});

it('checks availability and respects max quantity', function () {
    $extra = Extra::factory()->create([
        'name' => 'Postýlka',
        'price_type' => 'per_stay',
        'price' => 300,
        'max_quantity' => 2,
        'is_active' => true,
    ]);

    $booking = Booking::query()->create([
        'start_date' => '2025-11-10',
        'end_date' => '2025-11-12',
        'total_price' => 1000,
        'status' => BookingStatus::Confirmed,
    ]);
    $booking->extras()->attach($extra->id, [
        'quantity' => 1,
        'price_total' => 300,
    ]);

    $payload = [
        'start_date' => '2025-11-11',
        'end_date' => '2025-11-11',
        'selections' => [
            ['extra_id' => $extra->id, 'quantity' => 2],
        ],
    ];

    $res = $this->postJson('/api/extras/availability', $payload);
    $res->assertSuccessful();
    $res->assertJson(['available' => false]);
    $items = $res->json('items');
    expect($items[0]['available_quantity'])->toBe(1);
});
