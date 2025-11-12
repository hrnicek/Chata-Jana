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
                    'price' => 5500,
                ],
            ],
            [
                'name' => 'ZIMA',
                'start_date' => now()->year.'-12-01',
                'end_date' => (now()->year + 1).'-02-28',
                'is_fixed_range' => false,
                'prices' => [
                    'price' => 4500,
                ],
            ],
            [
                'name' => 'MIMOSEZONA',
                'start_date' => now()->year.'-03-01',
                'end_date' => now()->year.'-05-31',
                'is_fixed_range' => false,
                'prices' => [
                    'price' => 3500,
                ],
            ],
            [
                'name' => 'SILVESTR',
                'start_date' => (now()->year + 1).'-12-31',
                'end_date' => (now()->year + 1).'-01-01',
                'is_fixed_range' => true,
                'prices' => [
                    'price' => 8000,
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
