<?php

namespace App\Enums;

enum DonationType: string
{
    case INFAK_RUTIN = 'infak-rutin';
    case INFAK_KOTAK = 'infak-kotak';
    case INFAK_KALENG = 'infak-kaleng';

    public function getLabel(): string
    {
        return match ($this) {
            DonationType::INFAK_RUTIN => 'Infak Rutin',
            DonationType::INFAK_KOTAK => 'Infak Kotak',
            DonationType::INFAK_KALENG => 'Infak Kaleng',
        };
    }
}
