<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')->schema([
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
                        ->required()
                        ->placeholder('Password minimal 8 karakter'),
                    Select::make('role')
                        ->options(UserRole::class)
                        ->native(false)
                        ->required()
                        ->default('user')
                        ->placeholder('Role user'),
                    TextInput::make('target')
                        ->label('Monthly Target')
                        ->numeric()
                        ->prefix('Rp.')
                        ->helperText('Masukkan target bulanan dalam Rupiah')
                        ->columnSpanFull(),
                ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
