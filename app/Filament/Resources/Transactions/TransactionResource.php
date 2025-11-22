<?php

namespace App\Filament\Resources\Transactions;

use App\Enums\TransactionStatus;
use App\Filament\Resources\Transactions\Pages\CreateTransaction;
use App\Filament\Resources\Transactions\Pages\EditTransaction;
use App\Filament\Resources\Transactions\Pages\ListTransactions;
use App\Filament\Resources\Transactions\Schemas\TransactionForm;
use App\Filament\Resources\Transactions\Tables\TransactionsTable;
use App\Models\Transaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    public static function form(Schema $schema): Schema
    {
        return TransactionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransactionsTable::configure($table);
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
            "index" => ListTransactions::route("/"),
            "create" => CreateTransaction::route("/create"),
            "edit" => EditTransaction::route("/{record}/edit"),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = filament()->auth()->user();

        return static::getModel()
            ::query()
            ->when(
                $user->isUser(),
                fn($query): Builder => $query->where("user_id", $user->id),
            );
    }

    public static function getNavigationBadge(): ?string
    {
        $pendingCount = static::getModel()
            ::query()
            ->whereStatus(TransactionStatus::Pending)
            ->count();

        return $pendingCount > 0 ? $pendingCount : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return "warning";
    }
}
