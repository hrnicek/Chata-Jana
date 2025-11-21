<?php

namespace App\Http\Controllers;

class BookingController extends Controller
{
    public function calendar()
    {
        seo()->title('Rezervace');
        return inertia('booking/Index', [
            'bookingConfig' => [
                'minLeadDays' => (int) config('booking.min_lead_days', 1),
                'timezone' => (string) config('booking.timezone', 'Europe/Prague'),
            ],
        ]);
    }
}
