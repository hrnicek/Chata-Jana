<?php

namespace App\Events;

use App\Models\Booking;

class BookingPaymentReceived
{
    public function __construct(public Booking $booking, public float $amount) {}
}
