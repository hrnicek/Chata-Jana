<?php

namespace App\Events;

use App\Models\Booking;

class BookingCanceled
{
    public function __construct(public Booking $booking) {}
}
