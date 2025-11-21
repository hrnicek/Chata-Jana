<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $start = Carbon::now()->addDays($this->faker->numberBetween(5, 60))->startOfDay();
        $nights = $this->faker->numberBetween(2, 5);
        $end = $start->copy()->addDays($nights - 1);

        $season = Season::query()->with('seasonPrices')->get()->first(function (Season $s) use ($start) {
            $md = $start->format('m-d');
            $startMd = $s->start_date->format('m-d');
            $endMd = $s->end_date->format('m-d');
            if ($startMd <= $endMd) {
                return $md >= $startMd && $md <= $endMd;
            }

            return $md >= $startMd || $md <= $endMd;
        });

        $price = $season?->seasonPrices->first()?->price ?? 0;

        return [
            'season_id' => $season?->id,
            'customer_id' => null,
            'start_date' => $start->toDateString(),
            'end_date' => $end->toDateString(),
            'total_price' => $price * $nights,
            'status' => 'confirmed',
        ];
    }
}
