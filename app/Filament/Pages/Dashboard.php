<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\TargetIndicatorWidget;
use App\Filament\Widgets\UserProgessWidget;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Home;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create-transaction')
                ->label('Create Transaction')
                ->url(route('filament.dashboard.resources.transactions.create')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            TargetIndicatorWidget::class,
            UserProgessWidget::class,
        ];
    }
}
