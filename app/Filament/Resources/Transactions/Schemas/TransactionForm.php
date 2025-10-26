<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Transaksi')
                ->description('Pastikan data yang dimasukkan sudah benar.')
                ->schema([
                    Grid::make()
                        ->schema([
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->native(false)
                                ->required()
                                ->placeholder('Pilih user')
                                ->visible(Auth::user()->isAdmin()),
                            Select::make('donatur_id')
                                ->relationship('donatur', 'name')
                                ->native(false)
                                ->required()
                                ->searchable()
                                ->preload()
                                ->placeholder('Pilih donatur'),
                        ])->columns(Auth::user()->isAdmin() ? 2 : 1),
                    Grid::make()
                        ->schema([
                            TextInput::make('amount')
                                ->prefix('Rp')
                                ->required()
                                ->numeric()
                                ->placeholder('Nominal donasi'),
                            Select::make('type')
                                ->options(\App\Enums\DonationType::class)
                                ->native(false)
                                ->default('infak-kotak')
                                ->required()
                                ->placeholder('Jenis donasi'),
                        ])->columns(2),
                    FileUpload::make('proof_file')
                        ->image()
                        ->required()
                        ->placeholder('Upload bukti transfer')
                        ->imageEditor()
                        ->directory('proofs')
                        ->downloadable(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
