<?php

namespace App\Filament\Resources\Targets\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class TargetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Target Details')
                    ->schema([
                        Select::make('user_id')
                            ->native(false)
                            ->label('Petugas')
                            ->relationship('user', 'name')
                            ->required(),
                        TextInput::make('value')
                            ->label('Target')
                            ->required(),
                    ])->columnSpanFull(),
            ]);
    }
}
