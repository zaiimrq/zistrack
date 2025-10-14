<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\DonationType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('donatur_id')
                    ->relationship('donatur', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('type')
                    ->options(DonationType::class)
                    ->default('infak-kotak')
                    ->required(),
                TextInput::make('proof_file')
                    ->required(),
            ]);
    }
}
