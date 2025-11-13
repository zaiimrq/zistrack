<?php

namespace App\Filament\Resources\Donaturs\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class DonaturForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Donatur')
                ->description('Pastikan data yang dimasukkan sudah benar.')
                ->schema([
                    Select::make('user_id')
                        ->relationship(
                            'user',
                            'name',
                            modifyQueryUsing: fn (
                                Builder $query,
                            ): Builder => $query->whereRole(UserRole::USER),
                        )
                        ->native(false)
                        ->required()
                        ->placeholder('Pilih user')
                        ->visible(Auth::user()->isAdmin()),
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
