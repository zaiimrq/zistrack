<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case LEADER = 'leader';

    public function getLabel(): string
    {
        return match ($this) {
            UserRole::ADMIN => 'Administrator',
            UserRole::USER => 'User',
            UserRole::LEADER => 'Leader',
        };
    }
}
