<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case ADMIN = 'admin';
    case USER = 'user';
    case LEADER = 'leader';

    public function getLabel(): string
    {
        return match ($this) {
            UserRole::ADMIN => 'Admin',
            UserRole::USER => 'User',
            UserRole::LEADER => 'Leader',
        };
    }
}
