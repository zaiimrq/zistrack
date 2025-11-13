<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureSomething();
        Number::useLocale('id');
        Number::useCurrency('IDR');
    }

    private function configureSomething(): void
    {
        // Date configuration
        Date::use(CarbonImmutable::class);

        // Vite configuration
        Vite::useWaterfallPrefetching();

        // DB configuration
        DB::prohibitDestructiveCommands(app()->isProduction());

        FilamentAsset::register([
            Js::make(
                'apex-script',
                Vite::asset('resources/js/apex.js'),
            )->module(),
        ]);
    }
}
