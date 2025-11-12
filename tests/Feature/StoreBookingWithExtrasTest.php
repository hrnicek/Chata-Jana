<?php

use App\Models\Extra;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores booking with extras and attaches pivot with totals', function () {
    $perDay = Extra::factory()->create([
        'name' => 'Pes',
        'price_type' => 'per_day',
        'price' => 300,
        'max_quantity' => 10,
        'is_active' => true,
    ]);
    $perStay = Extra::factory()->create([
        'name' => 'Postýlka',
        'price_type' => 'per_stay',
        'price' => 500,
        'max_quantity' => 2,
        'is_active' => true,
    ]);

    $payload = [
        'start_date' => '2025-11-20',
        'end_date' => '2025-11-22', // 3 nights
        'customer' => [
            'first_name' => 'Jan',
            'last_name' => 'Novák',
            'email' => 'jan@example.com',
            'phone' => '+420123456789',
            'note' => '',
        ],
        'addons' => [
            ['extra_id' => $perDay->id, 'quantity' => 2],
            ['extra_id' => $perStay->id, 'quantity' => 1],
        ],
        'accommodation_total' => 3000,
    ];

    $res = $this->postJson('/api/bookings', $payload);
    $res->assertSuccessful();

    $bookingId = $res->json('id');
    $this->assertDatabaseHas('booking_extras', [
        'booking_id' => $bookingId,
        'extra_id' => $perDay->id,
        'quantity' => 2,
        'price_total' => 2 * 3 * 300,
    ]);
    $this->assertDatabaseHas('booking_extras', [
        'booking_id' => $bookingId,
        'extra_id' => $perStay->id,
        'quantity' => 1,
        'price_total' => 1 * 500,
    ]);
});
