<?php

namespace App\Filament\Resources\Donaturs\Pages;

use App\Filament\Resources\Donaturs\DonaturResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDonatur extends CreateRecord
{
    protected static string $resource = DonaturResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        if ($user->isUser()) {
            $data['user_id'] = $user->id;
        }

        return $data;
    }
}
