<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Tables\Table;
use App\Models\BookingStatus;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Group;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('customer.name')
                    ->label('Zákazník')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Příjezd')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Odjezd')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Stav')
                    ->badge()
                    ->color(fn(BookingStatus $state): string => match ($state->value) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn(BookingStatus $state): string => match ($state->value) {
                        'pending' => 'Čekající',
                        'confirmed' => 'Potvrzeno',
                        'cancelled' => 'Zrušeno',
                        default => $state->value,
                    }),
                TextColumn::make('total_price')
                    ->label('Cena')
                    ->money('CZK')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Stav')
                    ->options([
                        'pending' => 'Čekající',
                        'confirmed' => 'Potvrzeno',
                        'cancelled' => 'Zrušeno',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                // DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->groups([]);
    }
}
