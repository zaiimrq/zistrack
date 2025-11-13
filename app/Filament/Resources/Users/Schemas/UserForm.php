<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('User Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->placeholder('Nama lengkap'),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->placeholder('Alamat email')
                        ->helperText('Masukkan email aktif'),
                    TextInput::make('password')
                        ->password()
                        ->required(
                            fn (string $operation): bool => $operation ===
                                'create',
                        )
                        ->placeholder('Password minimal 8 karakter'),
                    Select::make('role')
                        ->options(UserRole::class)
                        ->default(UserRole::USER)
                        ->native(false)
                        ->required()
                        ->placeholder('Role user')
                        ->live(),
                    TextInput::make('target')
                        ->visible(
                            fn (Get $get): bool => $get('role') ===
                                UserRole::USER,
                        )
                        ->label('Monthly Target')
                        ->helperText('Masukkan target bulanan dalam Rupiah')
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->prefix('Rp.')
                        ->inputMode('decimal')
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }
}
