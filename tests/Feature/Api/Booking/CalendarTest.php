<?php

use App\Models\BlackoutDate;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns availability for given month and year', function () {
    $this->seed(\Database\Seeders\SeasonSeeder::class);
    $customer = \App\Models\Customer::create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '123456789',
    ]);

    Booking::query()->create([
        'season_id' => null,
        'customer_id' => $customer->id,
        'code' => '123456',
        'start_date' => '2025-11-10',
        'end_date' => '2025-11-12',
        'total_price' => 1000,
        'status' => 'confirmed',
    ]);

    BlackoutDate::query()->create([
        'start_date' => '2025-11-20',
        'end_date' => '2025-11-22',
        'reason' => 'maintenance',
    ]);

    $response = $this->getJson('/api/bookings/calendar?month=11&year=2025');

    $response->assertSuccessful();

    $data = $response->json('days');

    $day11 = collect($data)->firstWhere('date', '2025-11-11');
    expect($day11)->not->toBeNull();
    expect($day11['available'])->toBeFalse();

    $day21 = collect($data)->firstWhere('date', '2025-11-21');
    expect($day21)->not->toBeNull();
    expect($day21['available'])->toBeFalse();

    $day5 = collect($data)->firstWhere('date', '2025-11-05');
    expect($day5)->not->toBeNull();
    expect($day5['available'])->toBeTrue();
    expect($day5['price'])->toEqual(6000.0);
    expect($day5['season_is_default'])->toBeTrue();
});
