<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DonationType: string implements HasLabel
{
    case ZAKAT = 'zakat';
    case INFAK_UMUM = 'infak-umum';
    case INFAK_KHUSUS = 'infak-khusus';

    public function getLabel(): string
    {
        return match ($this) {
            DonationType::ZAKAT => 'Zakat',
            DonationType::INFAK_UMUM => 'Infak Umum',
            DonationType::INFAK_KHUSUS => 'Infak Khusus',
        };
    }
}
