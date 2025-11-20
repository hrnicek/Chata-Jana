<?php

namespace App\Filament\Resources\Seasons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SeasonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Základní informace')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Název')
                                    ->required()
                                    ->maxLength(255),
                                Toggle::make('is_default')
                                    ->label('Výchozí sezóna')
                                    ->required(),
                            ]),
                    ]),
                Section::make('Termín')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('Začátek')
                                    ->required(),
                                DatePicker::make('end_date')
                                    ->label('Konec')
                                    ->required(),
                                Toggle::make('is_fixed_range')
                                    ->label('Pevný termín')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }
}
