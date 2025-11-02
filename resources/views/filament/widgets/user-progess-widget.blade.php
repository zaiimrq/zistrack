<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">
                        User Progress Overview
                    </h3>
                    <p class="text-sm">
                        Track each user's monthly achievement toward their target
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach ($users as $user)
                    @php
                        $progress = $user->progress ?? 0;
                        $current = $user->current ?? 0;
                        $target = $user->target ?? 1;
                        $percent = $target > 0 ? round(($current / $target) * 100, 1) : 0;
                        
                        [$color, $status] = match (true) {
                            $percent >= 100 => ['bg-success-500', 'Excellent'],
                            $percent >= 80 => ['bg-primary-500', 'On Track'],
                            $percent >= 50 => ['bg-warning-400', 'Improving'],
                            default => ['bg-danger-500', 'Needs Work'],
                        };
                    @endphp

                    <div
                        class="rounded-2xl backdrop-blur-md p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <h4 class="font-semibold">
                                    {{ $user->name }}
                                </h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $status }}
                                </p>
                            </div>

                            <span class="text-sm font-medium">
                                {{ number_format($percent, 1) }}%
                            </span>
                        </div>

                        <div class="w-full bg-gray-200 dark:bg-gray-300 rounded-full h-3 overflow-hidden">
                            <div class="{{ $color }} h-3 rounded-full transition-all duration-700"
                                style="width: {{ min($percent, 100) }}%"></div>
                        </div>

                        <div class="mt-3 flex justify-between text-xs">
                            <span>Rp {{ number_format($current, 0, ',', '.') }}</span>
                            <span>Target: Rp {{ number_format($target, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
