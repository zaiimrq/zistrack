<?php

namespace App\Filament\Resources\Donaturs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonaturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->placeholder('Pilih user'),
                TextInput::make('name')
                    ->required()
                    ->placeholder('Nama donatur'),
                TextInput::make('phone')
                    ->tel()
                    ->numeric()
                    ->placeholder('Nomor telepon'),
                TextInput::make('address')
                    ->required()
                    ->placeholder('Alamat lengkap'),
            ]);
    }
}
