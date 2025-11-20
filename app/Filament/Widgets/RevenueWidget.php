<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $now = Carbon::now();
        $currentMonth = $now->format('Y-m');
        $previousMonth = $now->copy()->subMonth()->format('Y-m');

        // Current month revenue (confirmed bookings)
        $currentRevenue = Booking::where('status', 'confirmed')
            ->whereRaw("DATE_FORMAT(start_date, '%Y-%m') = ?", [$currentMonth])
            ->sum('total_price');

        // Previous month revenue for comparison
        $previousRevenue = Booking::where('status', 'confirmed')
            ->whereRaw("DATE_FORMAT(start_date, '%Y-%m') = ?", [$previousMonth])
            ->sum('total_price');

        // Calculate percentage change
        $percentChange = 0;
        if ($previousRevenue > 0) {
            $percentChange = round((($currentRevenue - $previousRevenue) / $previousRevenue) * 100, 1);
        }

        $trendIcon = $percentChange > 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';
        $trendColor = $percentChange > 0 ? 'success' : ($percentChange < 0 ? 'danger' : 'gray');

        return [
            Stat::make('Tržby', number_format($currentRevenue, 0, ',', ' ') . ' Kč')
                ->description(($percentChange >= 0 ? '+' : '') . $percentChange . '% oproti minulému měsíci')
                ->descriptionIcon($trendIcon)
                ->color($trendColor),
        ];
    }
}
