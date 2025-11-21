<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informace o rezervaci')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('date_start')
                                    ->label('Příjezd')
                                    ->seconds(false)
                                    ->required(),
                                DateTimePicker::make('date_end')
                                    ->label('Odjezd')
                                    ->seconds(false)
                                    ->required(),
                                Select::make('status')
                                    ->label('Stav')
                                    ->options([
                                        'pending' => 'Čekající',
                                        'confirmed' => 'Potvrzeno',
                                        'cancelled' => 'Zrušeno',
                                    ])
                                    ->required(),
                            ]),
                    ]),
                Section::make('Cena')
                    ->schema([
                        TextInput::make('total_price')
                            ->label('Celková cena')
                            ->numeric()
                            ->prefix('Kč')
                            ->required(),
                    ]),
            ]);
    }
}
