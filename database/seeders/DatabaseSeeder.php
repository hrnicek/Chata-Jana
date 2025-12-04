<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        // Seeders for booking system will be added separately
    }
}
