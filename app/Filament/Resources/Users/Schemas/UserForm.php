<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('google_id')
                    ->placeholder('Google ID'),
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
                TextInput::make('role')
                    ->required()
                    ->default('user')
                    ->placeholder('Role user'),
            ]);
    }
}
