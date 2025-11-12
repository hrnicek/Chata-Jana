<?php

namespace App\Http\Controllers\Api\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\CalendarRequest;
use App\Models\BlackoutDate;
use App\Models\Booking;
use App\Models\Season;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class CalendarController extends Controller
{
    public function index(CalendarRequest $request): JsonResponse
    {
        $month = (int) ($request->validated()['month'] ?? now()->month);
        $year = (int) ($request->validated()['year'] ?? now()->year);

        $periodStart = Carbon::create($year, $month, 1)->startOfMonth();
        $periodEnd = Carbon::create($year, $month, 1)->endOfMonth();

        $seasons = Season::query()
            ->with('seasonPrices')
            ->get();

        $bookings = Booking::query()
            ->where('status', '!=', 'cancelled')
            ->where('start_date', '<=', $periodEnd->toDateString())
            ->where('end_date', '>=', $periodStart->toDateString())
            ->get();

        $blackouts = BlackoutDate::query()
            ->where('start_date', '<=', $periodEnd->toDateString())
            ->where('end_date', '>=', $periodStart->toDateString())
            ->get();

        $days = [];
        $date = $periodStart->copy();

        while ($date->lte($periodEnd)) {
            $season = $seasons->first(function (Season $s) use ($date) {
                $md = $date->format('m-d');
                $startMd = $s->start_date->format('m-d');
                $endMd = $s->end_date->format('m-d');
                if ($startMd <= $endMd) {
                    return $md >= $startMd && $md <= $endMd;
                }

                return $md >= $startMd || $md <= $endMd;
            });

            $seasonPrice = $season?->seasonPrices->first();

            $isBlackout = $blackouts->contains(function (BlackoutDate $b) use ($date) {
                return $date->between($b->start_date, $b->end_date);
            });

            $isBooked = $bookings->contains(function (Booking $b) use ($date) {
                return $date->between($b->start_date, $b->end_date);
            });

            $days[] = [
                'date' => $date->toDateString(),
                'available' => ! ($isBlackout || $isBooked),
                'season' => $season?->name,
                'price' => $seasonPrice?->price,
            ];

            $date = $date->addDay();
        }

        return response()->json([
            'month' => $month,
            'year' => $year,
            'days' => $days,
        ]);
    }
}
