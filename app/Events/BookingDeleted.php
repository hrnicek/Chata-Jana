<?php

namespace App\Events;

use App\Models\Booking;

class BookingDeleted
{
    public function __construct(public Booking $booking) {}
}
