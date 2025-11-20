<?php

namespace App\Filament\Resources\BookingPayments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingPaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.id')
                    ->label('Rezervace ID')
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Částka')
                    ->money('CZK')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Stav')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'refunded' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Čekající',
                        'paid' => 'Zaplaceno',
                        'refunded' => 'Vráceno',
                        default => $state,
                    }),
                TextColumn::make('payment_method')
                    ->label('Metoda')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'bank_transfer' => 'Bankovní převod',
                        'card' => 'Kartou',
                        'cash' => 'Hotově',
                        default => $state,
                    }),
                TextColumn::make('paid_at')
                    ->label('Zaplaceno dne')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Stav')
                    ->options([
                        'pending' => 'Čekající',
                        'paid' => 'Zaplaceno',
                        'refunded' => 'Vráceno',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
