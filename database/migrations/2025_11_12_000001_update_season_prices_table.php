<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('season_prices', function (Blueprint $table) {
            $table->dropColumn(['price_per_night', 'price_per_week', 'min_nights', 'max_nights']);
            $table->decimal('price', 10, 2)->after('season_id');
        });
    }

    public function down(): void
    {
        Schema::table('season_prices', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->decimal('price_per_night', 10, 2)->after('season_id');
            $table->decimal('price_per_week', 10, 2)->nullable()->after('price_per_night');
            $table->integer('min_nights')->default(1)->after('price_per_week');
            $table->integer('max_nights')->nullable()->after('min_nights');
        });
    }
};
