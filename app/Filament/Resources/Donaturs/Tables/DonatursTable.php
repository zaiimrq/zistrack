<?php

namespace App\Filament\Resources\Donaturs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonatursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable()
                    ->icon('heroicon-o-user'),
                TextColumn::make('phone')
                    ->numeric()
                    ->color('info')
                    ->sortable(),
                TextColumn::make('address')
                    ->badge()
                    ->color('warning')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
