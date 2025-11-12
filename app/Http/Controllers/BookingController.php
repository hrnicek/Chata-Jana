<?php

namespace App\Http\Controllers;

class BookingController extends Controller
{
    public function calendar()
    {
        seo()->title('Rezervace');

        return inertia('booking/Index');
    }
}
