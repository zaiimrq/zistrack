<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Builder;
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
                                ->relationship(
                                    'user',
                                    'name',
                                    modifyQueryUsing: fn (
                                        Builder $query,
                                    ): Builder => $query->whereRole(
                                        UserRole::USER,
                                    ),
                                )
                                ->native(false)
                                ->required()
                                ->placeholder('Pilih user')
                                ->visible(Auth::user()->isAdmin()),
                            Select::make('donatur_id')
                                ->relationship(
                                    'donatur',
                                    'name',
                                    modifyQueryUsing: fn (
                                        Builder $query,
                                        Get $get,
                                    ): Builder => $query->whereUserId(
                                        $get('user_id'),
                                    ),
                                )
                                ->native(false)
                                ->required()
                                ->searchable()
                                ->preload()
                                ->placeholder('Pilih donatur'),
                        ])
                        ->columns(Auth::user()->isAdmin() ? 2 : 1),
                    Grid::make()
                        ->schema([
                            TextInput::make('amount')
                                ->required()
                                ->placeholder('Nominal donasi')
                                ->mask(RawJs::make('$money($input)'))
                                ->stripCharacters(',')
                                ->numeric()
                                ->prefix('Rp.')
                                ->inputMode('decimal'),
                            // Select::make('type')
                            //     ->options(\App\Enums\DonationType::class)
                            //     ->native(false)
                            //     ->default('infak-kotak')
                            //     ->required()
                            //     ->placeholder('Jenis donasi'),
                        ])
                        ->columns(1),
                    FileUpload::make('proof_file')
                        ->image()
                        ->required()
                        ->placeholder('Upload bukti transfer')
                        ->directory('proofs')
                        ->downloadable(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
