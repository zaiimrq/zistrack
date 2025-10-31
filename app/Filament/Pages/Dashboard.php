<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverviewWidget;
use Filament\Actions\Action;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

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
        ];
    }
}
