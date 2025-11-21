<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jakub Hrnčíř',
            'email' => 'hrncir@zondy.cz',
            'password' => bcrypt('password'),
        ]);

        $this->call(SeasonSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(BlackoutDateSeeder::class);
    }
}
