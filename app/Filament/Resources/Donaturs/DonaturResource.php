<?php

namespace App\Filament\Resources\Donaturs;

use App\Filament\Resources\Donaturs\Pages\CreateDonatur;
use App\Filament\Resources\Donaturs\Pages\EditDonatur;
use App\Filament\Resources\Donaturs\Pages\ListDonaturs;
use App\Filament\Resources\Donaturs\Schemas\DonaturForm;
use App\Filament\Resources\Donaturs\Tables\DonatursTable;
use App\Models\Donatur;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DonaturResource extends Resource
{
    protected static ?string $model = Donatur::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DonaturForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonatursTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDonaturs::route('/'),
            'create' => CreateDonatur::route('/create'),
            'edit' => EditDonatur::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = filament()->auth()->user();

        return static::getModel()::query()
            ->when(
                $user->isUser(),
                fn ($query): Builder => $query->whereUserId($user),
            );
    }
}
