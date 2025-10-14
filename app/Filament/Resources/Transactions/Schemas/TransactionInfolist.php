<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('donatur.name')
                    ->label('Donatur'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('type')
                    ->badge(),
                TextEntry::make('proof_file'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
