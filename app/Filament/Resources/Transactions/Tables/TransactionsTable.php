<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort(column: 'id', direction: 'desc')
            ->searchable(false)
            ->columns([
                TextColumn::make('donatur.name')->searchable(),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('amount')
                    ->formatStateUsing(
                        fn ($record) => Number::currency(
                            $record->amount,
                            in: 'IDR',
                            locale: 'id',
                            precision: 0,
                        ),
                    )
                    ->color('success')
                    ->sortable(),
                ImageColumn::make('proof_file')->label('Proof'),

                TextColumn::make('created_at')
                    ->since('Asia/Jayapura')
                    ->badge()
                    ->color('warning')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
