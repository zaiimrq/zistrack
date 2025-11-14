<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;

class UserProgessWidget extends Widget
{
    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.user-progess-widget';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'users' => User::withSum('transactions as current', 'amount')
                ->whereRelation(
                    'transactions',
                    fn ($query) => $query->thisMonth()->approved(),
                )
                ->orDoesntHave('transactions')
                ->whereRole('user')
                ->get(),
        ];
    }

    private function getCurrentIncome(User $user): float|int
    {
        return $user->transactions()->thisMonth()->sum('amount');
    }
}
