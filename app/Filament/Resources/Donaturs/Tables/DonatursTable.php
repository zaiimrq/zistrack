<?php

namespace App\Filament\Resources\Donaturs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonatursTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort(column: 'id', direction: 'desc')
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->badge()
                    ->color('primary')
                    ->hidden(filament()->auth()->user()->isUser()),
                TextColumn::make('name')->searchable()->icon('heroicon-o-user'),
                TextColumn::make('phone')->numeric()->color('info'),
                TextColumn::make('address')->badge()->color('warning'),
            ])
            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
