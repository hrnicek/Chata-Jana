<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Season;
use App\Models\SeasonPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class StoreBookingDebugTest extends TestCase
{
    use RefreshDatabase;

    public function test_debug_validation()
    {
        $data = [
            'start_date' => now()->addDays(10)->toDateString(),
            'end_date' => now()->addDays(12)->toDateString(),
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '123456789',
            ],
            'accommodation_total' => 5000,
            'grand_total' => 5000,
        ];

        $response = $this->postJson(route('api.bookings.store'), $data);

        if ($response->status() === 422) {
            dump($response->json());
        }

        $response->assertCreated();
    }
}
