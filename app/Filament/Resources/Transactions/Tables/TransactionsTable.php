<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donatur.name')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn ($state) => $state === 'infak-kotak' ? 'success' : 'warning')
                    ->searchable(),
                TextColumn::make('proof_file')
                    ->label('Proof')
                    ->url(fn ($record) => $record->proof_file)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-photo')
                    ->color('primary'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
