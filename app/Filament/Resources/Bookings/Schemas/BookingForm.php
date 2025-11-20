<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
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
                                DatePicker::make('start_date')
                                    ->label('Příjezd')
                                    ->required(),
                                DatePicker::make('end_date')
                                    ->label('Odjezd')
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
