<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
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
        $query = Transaction::query()->withUser()->approved();

        $thisMonthIncome = $query->clone()->thisMonth()->sum('amount');
        $lastMonthIncome = $query->clone()->lastMonth()->sum('amount');

        return [
            $this->renderIncomeStat(
                thisMonthIncome: $thisMonthIncome,
                lastMonthIncome: $lastMonthIncome,
            ),
            $this->renderTargetStat(),
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

    private function renderTargetStat(): Stat
    {
        $user = filament()->auth()->user();

        $target = match (true) {
            $user->isUser() => $user->target,
            default => $user->sum('target'),
        };

        return Stat::make('Target', $this->formatCurrency($target))
            ->label('Monthly Target')
            ->color('primary')
            ->description('🔥 Chase your target');
    }

    private function formatCurrency(int $amount): string
    {
        return Number::currency($amount, precision: 0);
    }
}
