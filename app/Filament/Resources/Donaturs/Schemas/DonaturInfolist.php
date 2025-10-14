<?php

namespace App\Filament\Resources\Donaturs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DonaturInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('name'),
                TextEntry::make('phone')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('address'),
            ]);
    }
}
