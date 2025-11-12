<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\SeasonPrice;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasons = [
            [
                'name' => 'LÉTO',
                'start_date' => now()->year.'-06-01',
                'end_date' => now()->year.'-08-31',
                'is_fixed_range' => false,
                'prices' => [
                    'price_per_night' => 5500,
                    'price_per_week' => 35000,
                    'min_nights' => 1,
                    'max_nights' => 30,
                ],
            ],
            [
                'name' => 'ZIMA',
                'start_date' => now()->year.'-12-01',
                'end_date' => (now()->year + 1).'-02-28',
                'is_fixed_range' => false,
                'prices' => [
                    'price_per_night' => 4500,
                    'price_per_week' => 28000,
                    'min_nights' => 1,
                    'max_nights' => 30,
                ],
            ],
            [
                'name' => 'MIMOSEZONA',
                'start_date' => now()->year.'-03-01',
                'end_date' => now()->year.'-05-31',
                'is_fixed_range' => false,
                'prices' => [
                    'price_per_night' => 3500,
                    'price_per_week' => 21000,
                    'min_nights' => 1,
                    'max_nights' => 30,
                ],
            ],
            [
                'name' => 'SILVESTR',
                'start_date' => (now()->year + 1).'-12-31',
                'end_date' => (now()->year + 1).'-01-01',
                'is_fixed_range' => true,
                'prices' => [
                    'price_per_night' => 8000,
                    'price_per_week' => null,
                    'min_nights' => 1,
                    'max_nights' => 1,
                ],
            ],
        ];

        foreach ($seasons as $seasonData) {
            $prices = $seasonData['prices'];
            unset($seasonData['prices']);

            $season = Season::create($seasonData);
            SeasonPrice::create(array_merge($prices, ['season_id' => $season->id]));
        }
    }
}
