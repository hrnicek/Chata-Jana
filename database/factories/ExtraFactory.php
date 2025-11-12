<?php

namespace Database\Factories;

use App\Models\Extra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Extra>
 */
class ExtraFactory extends Factory
{
    protected $model = Extra::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Pes', 'Postýlka', 'Parkování']),
            'price_type' => $this->faker->randomElement(['per_day', 'per_stay']),
            'price' => $this->faker->randomElement([150, 300, 500]),
            'max_quantity' => $this->faker->numberBetween(1, 5),
            'is_active' => true,
        ];
    }
}
