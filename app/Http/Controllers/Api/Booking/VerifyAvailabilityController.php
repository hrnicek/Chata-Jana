<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\VerifyAvailabilityRequest;
use App\Models\BlackoutDate;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class VerifyAvailabilityController extends Controller
{
    /**
     * Verify availability for a given date range.
     */
    public function __invoke(VerifyAvailabilityRequest $request): JsonResponse
    {
        $data = $request->validated();

        $checkin = config('booking.checkin_time', '14:00');
        $checkout = config('booking.checkout_time', '10:00');
        $start = Carbon::createFromFormat('Y-m-d H:i', $data['start_date'] . ' ' . $checkin);
        $end = Carbon::createFromFormat('Y-m-d H:i', $data['end_date'] . ' ' . $checkout);

        $minLeadDays = (int) config('booking.min_lead_days', 1);
        $earliest = now()->timezone(config('booking.timezone', 'Europe/Prague'))
            ->startOfDay()
            ->addDays($minLeadDays)
            ->setTimeFromTimeString($checkin);
        if ($start->lt($earliest)) {
            return response()->json([
                'available' => false,
                'unavailable_dates' => [],
            ]);
        }

        $bookings = Booking::query()
            ->where('status', '!=', 'cancelled')
            ->where('date_start', '<', $end)
            ->where('date_end', '>', $start)
            ->get();
        $hasOverlap = $bookings->isNotEmpty();

        $blackouts = BlackoutDate::query()
            ->where('start_date', '<=', $end->toDateString())
            ->where('end_date', '>=', $start->toDateString())
            ->get();

        $unavailableDates = [];
        $cursor = $start->copy()->startOfDay();
        $cursorEnd = $end->copy()->startOfDay();

        while ($cursor->lte($cursorEnd)) {
            $isBlackout = $blackouts->contains(function (BlackoutDate $b) use ($cursor) {
                return $cursor->between($b->start_date, $b->end_date);
            });

            $isBooked = $bookings->contains(function (Booking $b) use ($cursor) {
                $bookingStart = \Illuminate\Support\Carbon::parse($b->date_start)->startOfDay();
                $bookingEndExclusive = \Illuminate\Support\Carbon::parse($b->date_end)->subDay()->startOfDay();
                return $cursor->between($bookingStart, $bookingEndExclusive);
            });

            if ($isBlackout || $isBooked) {
                $unavailableDates[] = $cursor->toDateString();
            }

            $cursor = $cursor->addDay();
        }

        $available = (! $hasOverlap) && count($unavailableDates) === 0;

        return response()->json([
            'available' => $available,
            'unavailable_dates' => $unavailableDates,
        ]);
    }
}
