<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename extras table to services
        Schema::rename('extras', 'services');

        // Rename booking_extras pivot table to booking_services
        Schema::rename('booking_extras', 'booking_services');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse: rename services back to extras
        Schema::rename('services', 'extras');

        // Reverse: rename booking_services back to booking_extras
        Schema::rename('booking_services', 'booking_extras');
    }
};
