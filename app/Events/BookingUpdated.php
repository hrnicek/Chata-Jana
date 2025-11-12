<?php

namespace App\Events;

use App\Models\Booking;

class BookingUpdated
{
    public function __construct(public Booking $booking) {}
}
