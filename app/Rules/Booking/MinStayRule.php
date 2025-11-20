<?php

namespace App\Rules\Booking;

use Carbon\Carbon;
use App\Models\Season;

class MinStayRule implements BookingRule
{
    public function validate(Carbon $start, Carbon $end, ?Season $season): void
    {
        $nights = $start->diffInDays($end);
        $minStay = $season?->min_stay ?? 1; // Default to 1 night if no season or season has no min_stay

        if ($nights < $minStay) {
            throw new \Exception("Minimum stay for this period is {$minStay} nights.");
        }
    }
}
