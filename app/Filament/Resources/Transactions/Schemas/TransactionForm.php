<?php

namespace App\Filament\Resources\Transactions\Schemas;

use emmanpbarrameda\FilamentTakePictureField\Forms\Components\TakePicture;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make("Informasi Transaksi")
                ->description("Pastikan data yang dimasukkan sudah benar.")
                ->schema([
                    Select::make("donatur_id")
                        ->relationship("donatur", "name")
                        ->native(false)
                        ->required()
                        ->searchable()
                        ->preload()
                        ->placeholder("Pilih donatur"),
                    Select::make("user_id")
                        ->relationship("user", "name")
                        ->native(false)
                        ->required()
                        ->placeholder("Pilih user")
                        ->visible(Auth::user()->isAdmin()),
                    TextInput::make("amount")
                        ->prefix("Rp")
                        ->required()
                        ->numeric()
                        ->placeholder("Nominal donasi"),
                    Select::make("type")
                        ->options(\App\Enums\DonationType::class)
                        ->native(false)
                        ->default("infak-kotak")
                        ->required()
                        ->placeholder("Jenis donasi"),
                    TextInput::make("proof_file")
                        ->required()
                        ->placeholder("URL bukti transfer")
                        ->helperText("Upload/link bukti transfer"),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}
