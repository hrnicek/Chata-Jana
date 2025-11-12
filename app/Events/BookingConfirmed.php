<?php

namespace App\Events;

use App\Models\Booking;

class BookingConfirmed
{
    public function __construct(public Booking $booking) {}
}
