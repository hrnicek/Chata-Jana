<?php

namespace App\Events;

use App\Models\Booking;
use App\Models\Customer;

class BookingPlaced
{
    public function __construct(public Booking $booking, public Customer $customer) {}
}
