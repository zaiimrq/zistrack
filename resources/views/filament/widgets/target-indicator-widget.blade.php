<x-filament-widgets::widget>
    <x-filament::section>
        <div class="rounded-2xl" x-data="{}" x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('apex-script'))]">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-lg font-semibold">Monthly Target</h3>
                    <p class="text-sm">Your current performance this month</p>
                </div>

                <div id="indicatorBadge"
                    class="flex items-center space-x-1.5 rounded-full px-3 py-1.5 text-xs font-medium bg-success-100 text-success-700 dark:bg-success-500/20 dark:text-success-400 transition-all duration-300">
                    <span id="trendText">+Excelent</span>
                </div>
            </div>

            {{-- Chart --}}
            <div class="relative h-[260px] sm:h-[280px]">
                <div id="chartTwo" class="h-full" data-progress="{{ $progress }}" data-current="{{ $current }}"
                    data-target="{{ $target }}">
                </div>

                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <div class="text-center space-y-1">
                        <span id="indicatorValue"
                            class="block text-4xl font-bold transition-all duration-700 scale-105">
                            {{ number_format($progress, 0) }}%
                        </span>
                        <p class="text-xs tracking-wide">
                            <span id="currentValue">{{ number_format($current) }}</span>
                            <span>/</span>
                            <span id="targetValue">{{ number_format($target) }}</span>
                        </p>
                        <span class="text-xs font-medium">Progress</span>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
