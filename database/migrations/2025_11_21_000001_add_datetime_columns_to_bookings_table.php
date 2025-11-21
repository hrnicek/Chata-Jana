<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (! Schema::hasColumn('bookings', 'date_start')) {
                $table->dateTime('date_start')->nullable()->after('end_date');
            }
            if (! Schema::hasColumn('bookings', 'date_end')) {
                $table->dateTime('date_end')->nullable()->after('date_start');
            }
        });

        $checkin = config('booking.checkin_time', '14:00');
        $checkout = config('booking.checkout_time', '10:00');

        DB::table('bookings')->orderBy('id')->chunkById(100, function ($rows) use ($checkin, $checkout) {
            foreach ($rows as $row) {
                $start = $row->start_date ? Carbon::parse($row->start_date . ' ' . $checkin) : null;
                $end = $row->end_date ? Carbon::parse($row->end_date . ' ' . $checkout) : null;
                DB::table('bookings')->where('id', $row->id)->update([
                    'date_start' => $start,
                    'date_end' => $end,
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'date_start')) {
                $table->dropColumn('date_start');
            }
            if (Schema::hasColumn('bookings', 'date_end')) {
                $table->dropColumn('date_end');
            }
        });
    }
};

