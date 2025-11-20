<?php

namespace Tests\Feature;

use App\Models\BlackoutDate;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvailabilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_verify_availability_returns_true_when_free()
    {
        $response = $this->postJson(route('api.bookings.verify'), [
            'start_date' => now()->addDays(5)->toDateString(),
            'end_date' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertOk()
            ->assertJson([
                'available' => true,
                'unavailable_dates' => [],
            ]);
    }

    public function test_verify_availability_returns_false_when_booked()
    {
        Booking::create([
            'start_date' => now()->addDays(5)->toDateString(),
            'end_date' => now()->addDays(8)->toDateString(),
            'total_price' => 1000,
            'status' => 'confirmed',
        ]);

        // Try to book overlapping
        $response = $this->postJson(route('api.bookings.verify'), [
            'start_date' => now()->addDays(6)->toDateString(),
            'end_date' => now()->addDays(9)->toDateString(),
        ]);

        $response->assertOk()
            ->assertJson([
                'available' => false,
            ]);

        $this->assertNotEmpty($response->json('unavailable_dates'));
    }

    public function test_verify_availability_returns_false_when_blackout()
    {
        BlackoutDate::create([
            'start_date' => now()->addDays(10)->toDateString(),
            'end_date' => now()->addDays(12)->toDateString(),
            'reason' => 'Maintenance',
        ]);

        $response = $this->postJson(route('api.bookings.verify'), [
            'start_date' => now()->addDays(10)->toDateString(),
            'end_date' => now()->addDays(11)->toDateString(),
        ]);

        $response->assertOk()
            ->assertJson(['available' => false]);
    }
}
