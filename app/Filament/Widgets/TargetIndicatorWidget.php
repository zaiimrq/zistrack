<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\Widget;

class TargetIndicatorWidget extends Widget
{
    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.target-indicator-widget';

    protected int|string|array $columnSpan = 'full';

    public float $progress = 0;

    public float $target = 0;

    public float $current = 0;

    public function mount()
    {
        $this->setTarget();
        $this->setCurrent();
        $this->progress =
            $this->target > 0 ? ($this->current / $this->target) * 100 : 0;
    }

    private function setTarget(): void
    {
        $user = filament()->auth()->user();
        $this->target = match (true) {
            $user->isUser() => $user->target,
            default => $user->sum('target'),
        };
    }

    private function setCurrent(): void
    {
        $user = filament()->auth()->user();
        $this->current = Transaction::query()
            ->thisMonth()
            ->withUser()
            ->sum('amount');
    }
}
