<?php

namespace App\Events;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Foundation\Events\Dispatchable;

class BookingPlaced
{
    use Dispatchable;

    public function __construct(public Booking $booking, public Customer $customer) {}
}
