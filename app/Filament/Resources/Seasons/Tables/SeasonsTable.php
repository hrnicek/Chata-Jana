<?php

namespace App\Filament\Resources\Seasons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SeasonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Název')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Začátek')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Konec')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_default')
                    ->label('Výchozí')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_default')
                    ->label('Výchozí sezóna'),
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
