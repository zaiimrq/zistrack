<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort(column: 'id', direction: 'desc')
            ->searchable(false)
            ->columns([
                TextColumn::make('name')
                    ->icon('heroicon-o-user')
                    ->color('primary'),
                TextColumn::make('email')
                    ->label('Email address')
                    ->color('info'),
                TextColumn::make('target')
                    ->label('Target')
                    ->formatStateUsing(
                        fn ($state) => $state > 0
                            ? Number::currency($state, precision: 0)
                            : 'No Target',
                    ),
                TextColumn::make('role')->badge()->searchable(),
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
