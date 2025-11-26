<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Models\Transaction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
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
            ->columns([
                TextColumn::make('donatur.name')->searchable(),
                TextColumn::make('user.name')
                    ->hidden(filament()->auth()->user()->isUser())
                    ->searchable(),
                TextColumn::make('amount')
                    ->formatStateUsing(
                        fn ($record) => Number::currency(
                            $record->amount,
                            in: 'IDR',
                            locale: 'id',
                            precision: 0,
                        ),
                    )
                    ->color('success'),
                ImageColumn::make('proof_file')->label('Proof'),

                TextColumn::make('created_at')->date(format: 'd M Y'),
                TextColumn::make('status')
                    ->badge()
                    ->tooltip(
                        fn (Transaction $record): ?string => $record->note,
                    ),
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
