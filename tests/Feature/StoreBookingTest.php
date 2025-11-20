<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Extra;
use App\Models\Season;
use App\Models\SeasonPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class StoreBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_booking_with_new_customer()
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

        $response->assertCreated()
            ->assertJsonStructure(['id', 'status', 'customer']);

        $this->assertDatabaseHas('customers', ['email' => 'john@example.com']);
        $this->assertDatabaseHas('bookings', ['total_price' => 5000]);
    }

    public function test_deduplicates_existing_customer()
    {
        $customer = Customer::create([
            'first_name' => 'Old',
            'last_name' => 'Name',
            'email' => 'exist@example.com',
            'phone' => '000000000',
        ]);

        $data = [
            'start_date' => now()->addDays(20)->toDateString(),
            'end_date' => now()->addDays(22)->toDateString(),
            'customer' => [
                'first_name' => 'New',
                'last_name' => 'Name',
                'email' => 'exist@example.com', // Same email
                'phone' => '111111111',
            ],
            'accommodation_total' => 5000,
            'grand_total' => 5000,
        ];

        $response = $this->postJson(route('api.bookings.store'), $data);

        $response->assertCreated();

        // Should still be 1 customer
        $this->assertEquals(1, Customer::count());

        // Customer details should be updated
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'first_name' => 'New',
            'phone' => '111111111',
        ]);

        // Booking should belong to this customer
        $this->assertEquals($customer->id, Booking::first()->customer_id);
    }

    public function test_calculates_nights_correctly()
    {
        // 2 nights: 10th to 12th
        $data = [
            'start_date' => '2025-06-10',
            'end_date' => '2025-06-12',
            'customer' => [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test@test.com',
                'phone' => '123',
            ],
            'accommodation_total' => 2000,
            'grand_total' => 2000,
        ];

        $this->postJson(route('api.bookings.store'), $data)->assertCreated();

        // We can't easily check internal variable $nights, but we can check extras calculation if we add one
        // Or we trust the logic we just wrote. 
        // Let's add an extra priced per day to verify.

        $extra = Extra::create([
            'name' => 'Breakfast',
            'price' => 100,
            'price_type' => 'per_day',
            'max_quantity' => 10,
            'is_active' => true,
        ]);

        $data['addons'] = [
            ['extra_id' => $extra->id, 'quantity' => 1]
        ];
        // 2 nights * 100 = 200. Total should be 2200.
        $data['grand_total'] = 2200;
        $data['addons_total'] = 200;

        $response = $this->postJson(route('api.bookings.store'), $data);
        $response->assertCreated();

        $booking = Booking::latest('id')->first();
        $this->assertEquals(2200, $booking->total_price);

        $pivot = $booking->extras->first()->pivot;
        $this->assertEquals(200, $pivot->price_total); // 100 * 2 nights
    }
}
