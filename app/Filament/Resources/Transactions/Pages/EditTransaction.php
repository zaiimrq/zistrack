<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Enums\TransactionStatus;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Models\Transaction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        $user = filament()->auth()->user();

        $approvalActionButtons = $user->isAdmin()
            ? [
                Action::make('decline')
                    ->label('Decline')
                    ->color('warning')
                    ->hidden(
                        fn (Transaction $record): bool => $record->status ===
                            TransactionStatus::Decline,
                    )
                    ->schema([
                        Textarea::make('note')
                            ->required()
                            ->placeholder('Masukkan note'),
                    ])
                    ->action(function (array $data, Transaction $record) {
                        $record->update([
                            'note' => $data['note'],
                            'status' => TransactionStatus::Decline,
                        ]);
                    }),
                Action::make('approve')
                    ->label('Approve')
                    ->color('primary')
                    ->hidden(
                        fn (Transaction $record): bool => $record->status ===
                            TransactionStatus::Approve,
                    )
                    ->action(
                        fn (Transaction $record): int => $record->update([
                            'status' => TransactionStatus::Approve,
                            'note' => null,
                        ]),
                    ),
            ]
            : [];

        return [...$approvalActionButtons, DeleteAction::make()];
    }
}
