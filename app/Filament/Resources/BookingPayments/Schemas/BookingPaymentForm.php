<?php

namespace App\Filament\Resources\BookingPayments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingPaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Platba')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('booking_id')
                                    ->relationship('booking', 'id')
                                    ->label('Rezervace ID')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                TextInput::make('amount')
                                    ->label('Částka')
                                    ->numeric()
                                    ->prefix('Kč')
                                    ->required(),
                                Select::make('payment_method')
                                    ->label('Metoda platby')
                                    ->options([
                                        'bank_transfer' => 'Bankovní převod',
                                        'card' => 'Kartou',
                                        'cash' => 'Hotově',
                                    ])
                                    ->required(),
                                Select::make('status')
                                    ->label('Stav')
                                    ->options([
                                        'pending' => 'Čekající',
                                        'paid' => 'Zaplaceno',
                                        'refunded' => 'Vráceno',
                                    ])
                                    ->required(),
                                DateTimePicker::make('paid_at')
                                    ->label('Zaplaceno dne'),
                            ]),
                    ]),
            ]);
    }
}
