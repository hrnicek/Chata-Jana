<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Carbon\Carbon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class UpcomingArrivalsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->heading('Nadcházející příjezdy (7 dní)')
            ->query(
                Booking::query()
                    ->where('status', '!=', 'cancelled')
                    ->whereBetween('start_date', [
                        Carbon::now(),
                        Carbon::now()->addDays(7)
                    ])
                    ->with('customer')
                    ->orderBy('start_date', 'asc')
            )
            ->columns([
                TextColumn::make('code')
                    ->label('Kód')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Zákazník')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Příjezd')
                    ->date('d.m.Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Odjezd')
                    ->date('d.m.Y'),
                TextColumn::make('status')
                    ->label('Stav')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'confirmed' => 'Potvrzeno',
                        'pending' => 'Čeká',
                        'cancelled' => 'Zrušeno',
                        default => $state,
                    }),
            ]);
    }
}
