<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OccupancyWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $daysInMonth = $startOfMonth->daysInMonth;

        // Get confirmed bookings for current month
        $bookings = Booking::where('status', '!=', 'cancelled')
            ->where(function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                    ->orWhereBetween('end_date', [$startOfMonth, $endOfMonth])
                    ->orWhere(function ($q) use ($startOfMonth, $endOfMonth) {
                        $q->where('start_date', '<=', $startOfMonth)
                            ->where('end_date', '>=', $endOfMonth);
                    });
            })
            ->get();

        // Calculate occupied nights
        $occupiedNights = 0;
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->start_date)->max($startOfMonth);
            $end = Carbon::parse($booking->end_date)->min($endOfMonth);
            $nights = $start->diffInDays($end);
            $occupiedNights += max(0, $nights);
        }

        $occupancyRate = $daysInMonth > 0 ? round(($occupiedNights / $daysInMonth) * 100, 1) : 0;

        return [
            Stat::make('Obsazenost', $occupancyRate . '%')
                ->description('Aktuální měsíc')
                ->descriptionIcon('heroicon-o-calendar')
                ->color($occupancyRate >= 70 ? 'success' : ($occupancyRate >= 40 ? 'warning' : 'danger')),
        ];
    }
}
