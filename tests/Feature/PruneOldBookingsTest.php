<?php

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('prunes old soft-deleted bookings', function () {
    $this->seed(\Database\Seeders\SeasonSeeder::class);

    $customer = Customer::create([
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '123456789',
    ]);

    // Old soft-deleted booking (should be deleted)
    $oldBooking = Booking::create([
        'customer_id' => $customer->id,
        'code' => 'OLD123',
        'start_date' => '2025-01-01',
        'end_date' => '2025-01-05',
        'total_price' => 1000,
        'status' => 'pending',
    ]);
    $oldBooking->delete();
    $oldBooking->deleted_at = now()->subDays(31);
    $oldBooking->save();

    // Recent soft-deleted booking (should NOT be deleted)
    $recentBooking = Booking::create([
        'customer_id' => $customer->id,
        'code' => 'REC123',
        'start_date' => '2025-02-01',
        'end_date' => '2025-02-05',
        'total_price' => 1000,
        'status' => 'pending',
    ]);
    $recentBooking->delete();
    $recentBooking->deleted_at = now()->subDays(10);
    $recentBooking->save();

    // Active booking (should NOT be deleted)
    $activeBooking = Booking::create([
        'customer_id' => $customer->id,
        'code' => 'ACT123',
        'start_date' => '2025-03-01',
        'end_date' => '2025-03-05',
        'total_price' => 1000,
        'status' => 'pending',
    ]);

    $this->artisan('bookings:prune-old')
        ->expectsOutput('Pruned 1 old bookings.')
        ->assertExitCode(0);

    $this->assertDatabaseMissing('bookings', ['id' => $oldBooking->id]); // Should be gone completely
    $this->assertSoftDeleted('bookings', ['id' => $recentBooking->id]); // Should still exist as soft deleted
    $this->assertDatabaseHas('bookings', ['id' => $activeBooking->id]); // Should exist
});
