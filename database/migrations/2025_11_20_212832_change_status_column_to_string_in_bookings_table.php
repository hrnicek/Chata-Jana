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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // We cannot easily revert to enum with specific values using change() in SQLite/some drivers without losing data or complexity.
            // For now, we revert to string but conceptually it was enum.
            // Or we can try to revert to enum if supported.
            // $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->change();
        });
    }
};
