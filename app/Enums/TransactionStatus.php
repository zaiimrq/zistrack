<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum TransactionStatus: string implements HasColor, HasLabel
{
    case Pending = 'pending';
    case Approve = 'approve';
    case Decline = 'decline';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            TransactionStatus::Approve => 'Approve',
            TransactionStatus::Decline => 'Decline',
            TransactionStatus::Pending => 'Pending',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            TransactionStatus::Approve => 'primary',
            TransactionStatus::Decline => 'danger',
            TransactionStatus::Pending => 'warning',
        };
    }
}
