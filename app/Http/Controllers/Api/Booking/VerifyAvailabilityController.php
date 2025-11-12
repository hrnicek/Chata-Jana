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

        $start = Carbon::createFromFormat('Y-m-d', $data['start_date'])->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $data['end_date'])->endOfDay();

        $bookings = Booking::query()
            ->where('status', '!=', 'cancelled')
            ->where('start_date', '<=', $end->toDateString())
            ->where('end_date', '>=', $start->toDateString())
            ->get();

        $blackouts = BlackoutDate::query()
            ->where('start_date', '<=', $end->toDateString())
            ->where('end_date', '>=', $start->toDateString())
            ->get();

        $unavailableDates = [];
        $cursor = $start->copy();

        while ($cursor->lte($end)) {
            $isBlackout = $blackouts->contains(function (BlackoutDate $b) use ($cursor) {
                return $cursor->between($b->start_date, $b->end_date);
            });

            $isBooked = $bookings->contains(function (Booking $b) use ($cursor) {
                return $cursor->between($b->start_date, $b->end_date);
            });

            if ($isBlackout || $isBooked) {
                $unavailableDates[] = $cursor->toDateString();
            }

            $cursor = $cursor->addDay();
        }

        $available = count($unavailableDates) === 0;

        return response()->json([
            'available' => $available,
            'unavailable_dates' => $unavailableDates,
        ]);
    }
}
