<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Str;

class BookingObserver
{
    public function creating(Booking $booking): void
    {
        // Generate booking code if missing
        if (! $booking->code) {
            $year = now()->format('y');
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

        // Populate datetime boundaries if missing
        $checkin = config('booking.checkin_time', '14:00');
        $checkout = config('booking.checkout_time', '10:00');

        if (! $booking->date_start && $booking->start_date) {
            $booking->date_start = \Illuminate\Support\Carbon::parse($booking->start_date)
                ->setTimeFromTimeString($checkin);
        }

        if (! $booking->date_end && $booking->end_date) {
            $booking->date_end = \Illuminate\Support\Carbon::parse($booking->end_date)
                ->setTimeFromTimeString($checkout);
        }

        // Backfill date-only fields from datetimes if provided
        if ($booking->date_start && ! $booking->start_date) {
            $booking->start_date = \Illuminate\Support\Carbon::parse($booking->date_start)->toDateString();
        }
        if ($booking->date_end && ! $booking->end_date) {
            $booking->end_date = \Illuminate\Support\Carbon::parse($booking->date_end)->toDateString();
        }
    }
}
