<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Str;

class BookingObserver
{
    public function created(Booking $booking): void
    {
        if ($booking->code) {
            return;
        }

        $year = now()->format('y');

        // Find the last booking code for the current year
        // We expect codes in format YYXXXX (e.g. 250001)
        $lastBooking = Booking::query()
            ->where('code', 'like', $year . '%')
            ->orderByRaw('CAST(code AS UNSIGNED) DESC')
            ->first();

        if ($lastBooking && preg_match('/^' . $year . '(\d{4})$/', $lastBooking->code, $matches)) {
            $sequence = intval($matches[1]) + 1;
        } else {
            $sequence = 1;
        }

        $booking->code = $year . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
}
