<?php

namespace App\Rules\Booking;

use Carbon\Carbon;
use App\Models\Season;

interface BookingRule
{
    /**
     * Validate the booking parameters.
     *
     * @param Carbon $start
     * @param Carbon $end
     * @param Season|null $season
     * @return void
     * @throws \Exception
     */
    public function validate(Carbon $start, Carbon $end, ?Season $season): void;
}
