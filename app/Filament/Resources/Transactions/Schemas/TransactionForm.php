<?php

namespace App\Filament\Resources\Transactions\Schemas;

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
                    ->required()
                    ->placeholder('Pilih donatur'),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->placeholder('Pilih user'),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->placeholder('Nominal donasi'),
                Select::make('type')
                    ->options(\App\Enums\DonationType::class)
                    ->default('infak-kotak')
                    ->required()
                    ->placeholder('Jenis donasi'),
                TextInput::make('proof_file')
                    ->required()
                    ->placeholder('URL bukti transfer')
                    ->helperText('Upload/link bukti transfer'),
            ]);
    }
}
