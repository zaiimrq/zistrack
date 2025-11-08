<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static bool $isLazy = false;

    public function getColumns(): int|array
    {
        return 2;
    }

    protected function getStats(): array
    {
        $user = Auth::user();
        $query = Transaction::query()->withUser($user->isUser() ? $user : null);

        $thisMonthIncome = $query->clone()->thisMonth()->sum('amount');
        $lastMonthIncome = $query->clone()->lastMonth()->sum('amount');

        return [
            $this->renderIncomeStat(
                thisMonthIncome: $thisMonthIncome,
                lastMonthIncome: $lastMonthIncome,
            ),
            $this->renderTargetStat(
                user: $user,
                thisMonthIncome: $thisMonthIncome,
            ),
        ];
    }

    private function renderIncomeStat(
        int $thisMonthIncome,
        int $lastMonthIncome,
    ): Stat {
        $icon =
            $thisMonthIncome >= $lastMonthIncome
                ? 'heroicon-m-arrow-trending-up'
                : 'heroicon-m-arrow-trending-down';

        $color = $thisMonthIncome >= $lastMonthIncome ? 'success' : 'danger';

        return Stat::make('Income', $this->formatCurrency($thisMonthIncome))
            ->label('Total Income')
            ->color($color)
            ->description('Since last month')
            ->descriptionIcon($icon);
    }

    private function renderTargetStat(User $user, int $thisMonthIncome): Stat
    {
        $target = $user->isAdmin()
            ? User::query()->sum('target')
            : $user->target;

        return Stat::make('Target', $this->formatCurrency($target))
            ->label('Monthly Target')
            ->color('primary')
            ->description('🔥 Chase your target');
    }

    private function formatCurrency(int $amount): string
    {
        return Number::currency($amount, 'IDR', 'id', 0);
    }
}
