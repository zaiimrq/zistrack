<?php

namespace App\Filament\Resources\Donaturs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class DonaturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Donatur')
                    ->description('Pastikan data yang dimasukkan sudah benar.')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->native(false)
                            ->required()
                            ->placeholder('Pilih user')
                            ->hidden(! Auth::user()->isAdmin())
                            ->default(Auth::user()->id),
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('Nama donatur'),
                                TextInput::make('phone')
                                    ->tel()
                                    ->numeric()
                                    ->placeholder('Nomor telepon'),
                            ])
                            ->columns(2),
                        Textarea::make('address')
                            ->required()
                            ->placeholder('Alamat lengkap'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
