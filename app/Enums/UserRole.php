<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel, HasColor
{
    case ADMIN = "admin";
    case USER = "user";
    case LEAD = "lead";

    public function getLabel(): string
    {
        return match ($this) {
            UserRole::ADMIN => "Admin",
            UserRole::USER => "User",
            UserRole::LEAD => "Lead",
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            UserRole::ADMIN => "primary",
            UserRole::LEAD => "success",
            UserRole::USER => "warning",
        };
    }
}
