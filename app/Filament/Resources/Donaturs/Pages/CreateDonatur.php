<?php

namespace App\Filament\Resources\Donaturs\Pages;

use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Donaturs\DonaturResource;

class CreateDonatur extends CreateRecord
{
    protected static string $resource = DonaturResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        if (! $user->isAdmin()) {
            $data['user_id'] = $user->id;
        }

        return $data;
    }
}
