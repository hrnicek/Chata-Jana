<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PruneOldBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:prune-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune soft-deleted bookings older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = \App\Models\Booking::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(30))
            ->forceDelete();

        $this->info("Pruned {$count} old bookings.");
    }
}
