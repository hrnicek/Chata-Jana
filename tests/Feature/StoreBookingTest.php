<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Season;
use App\Models\SeasonPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class StoreBookingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\SeasonSeeder::class);
    }

    public function test_can_create_booking_with_new_customer()
    {
        $this->travelTo(now()->year . '-06-01'); // Start of Summer

        $data = [
            'start_date' => now()->addDays(10)->toDateString(), // Jun 11
            'end_date' => now()->addDays(12)->toDateString(),   // Jun 13 (2 nights)
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '123456789',
            ],
            // Summer price is 5500 per night. 2 nights = 11000.
            'accommodation_total' => 11000,
            'grand_total' => 11000,
        ];

        $response = $this->postJson(route('api.bookings.store'), $data);

        $response->assertCreated()
            ->assertJsonStructure(['message', 'booking' => ['id', 'status', 'customer']]);

        $this->assertDatabaseHas('customers', ['email' => 'john@example.com']);
        $this->assertDatabaseHas('bookings', ['total_price' => 11000]);
    }

    public function test_creates_new_customer_even_if_email_exists()
    {
        $this->travelTo(now()->year . '-06-01');

        $customer = Customer::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '123456789',
        ]);

        $data = [
            'start_date' => now()->addDays(10)->toDateString(),
            'end_date' => now()->addDays(12)->toDateString(),
            'customer' => [
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'jane@example.com',
                'phone' => '987654321',
            ],
            'accommodation_total' => 11000,
            'grand_total' => 11000,
        ];

        $this->postJson(route('api.bookings.store'), $data)->assertCreated();

        $this->assertEquals(2, Customer::where('email', 'jane@example.com')->count());
    }

    public function test_calculates_nights_correctly()
    {
        $this->travelTo(now()->year . '-06-01');

        $service = Service::create([
            'name' => 'Breakfast',
            'price' => 100,
            'price_type' => 'per_day',
            'max_quantity' => 10,
            'is_active' => true,
        ]);

        $data = [
            'start_date' => now()->addDays(20)->toDateString(), // Jun 21
            'end_date' => now()->addDays(22)->toDateString(),   // Jun 23 (2 nights)
            'customer' => [
                'first_name' => 'Bob',
                'last_name' => 'Smith',
                'email' => 'bob@example.com',
                'phone' => '111222333',
            ],
            // Summer price 5500 * 2 = 11000
            'accommodation_total' => 11000,
        ];

        $data['addons'] = [
            ['extra_id' => $service->id, 'quantity' => 1]
        ];
        // 2 nights * 100 = 200. Total should be 11200.
        $data['grand_total'] = 11200;
        $data['addons_total'] = 200;

        $response = $this->postJson(route('api.bookings.store'), $data);
        $response->assertCreated();

        $booking = Booking::latest('id')->first();
        $this->assertEquals(11200, $booking->total_price);

        $pivot = $booking->services->first()->pivot;
        $this->assertEquals(200, $pivot->price_total); // 100 * 2 nights
    }
}
