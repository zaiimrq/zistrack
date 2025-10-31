<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        return [
            $this->renderIncomeStat($user),
            $this->renderTargetStat($user),
        ];
    }

    private function renderIncomeStat(User $user): Stat
    {
        $income = Transaction::query()
            ->whereMonth('created_at', now()->month)
            ->when($user->isUser(), fn (Builder $query) => $query->whereUserId($user->id))
            ->sum('amount');

        return Stat::make('Income', $this->formatCurrency($income))
            ->label('Total Income')
            ->description('Since last month')
            ->descriptionIcon('heroicon-m-arrow-trending-up');
    }

    private function renderTargetStat(User $user): Stat
    {
        return Stat::make('Target', $this->formatCurrency($user->target))
            ->label('Monthly Target')
            ->description('Updated 2 days ago')
            ->descriptionIcon('heroicon-m-arrow-trending-up');
    }

    private function formatCurrency(int $amount): string
    {
        return Number::currency($amount, 'IDR', 'id', 0);
    }
}
