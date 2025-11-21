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
                $query->whereBetween('date_start', [$startOfMonth->copy()->startOfDay(), $endOfMonth->copy()->endOfDay()])
                    ->orWhereBetween('date_end', [$startOfMonth->copy()->startOfDay(), $endOfMonth->copy()->endOfDay()])
                    ->orWhere(function ($q) use ($startOfMonth, $endOfMonth) {
                        $q->where('date_start', '<=', $startOfMonth->copy()->startOfDay())
                            ->where('date_end', '>=', $endOfMonth->copy()->endOfDay());
                    });
            })
            ->get();

        // Calculate occupied nights
        $occupiedNights = 0;
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->date_start)->max($startOfMonth->copy()->startOfDay());
            $end = Carbon::parse($booking->date_end)->min($endOfMonth->copy()->endOfDay());
            $nights = $start->copy()->startOfDay()->diffInDays($end->copy()->startOfDay());
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
