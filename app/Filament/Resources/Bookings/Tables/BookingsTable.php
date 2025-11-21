<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Tables\Table;
use App\States\Booking\BookingState;
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
                TextColumn::make('date_start')
                    ->label('Příjezd')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('date_end')
                    ->label('Odjezd')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Stav')
                    ->badge()
                    ->color(fn(BookingState $state): string => $state->color())
                    ->formatStateUsing(fn(BookingState $state): string => match ($state->getValue()) {
                        'pending' => 'Čekající',
                        'confirmed' => 'Potvrzeno',
                        'completed' => 'Dokončeno',
                        'cancelled' => 'Zrušeno',
                        default => $state->getValue(),
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
                        'completed' => 'Dokončeno',
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
