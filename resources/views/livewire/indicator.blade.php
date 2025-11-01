<x-filament::section>
    <div
        class="rounded-2xl">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Monthly Target</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Your current performance this month</p>
            </div>

            <div id="indicatorBadge"
                class="flex items-center space-x-1.5 rounded-full px-3 py-1.5 text-xs font-medium bg-success-100 text-success-700 dark:bg-success-500/20 dark:text-success-400 transition-all duration-300">
                @svg('heroicon-o-arrow-trending-up', 'w-4 h-4')
                <span id="trendText">+10%</span>
            </div>
        </div>

        {{-- Chart --}}
        <div class="relative h-[260px] sm:h-[280px]">
            <div id="chartTwo" class="h-full"
                data-progress="{{ $progress ?? 75.55 }}"
                data-current="{{ $current ?? 8000000 }}"
                data-target="{{ $target ?? 10000000 }}">
            </div>

            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <div class="text-center space-y-1">
                    <span id="indicatorValue"
                        class="block text-4xl font-bold text-gray-900 dark:text-gray-100 transition-all duration-700 scale-105">
                        {{ number_format($progress ?? 75.55, 0) }}%
                    </span>
                    <p class="text-xs text-gray-500 dark:text-gray-400 tracking-wide">
                        <span id="currentValue">{{ number_format($current ?? 8000000) }}</span>
                        <span class="text-gray-400 dark:text-gray-500">/</span>
                        <span id="targetValue">{{ number_format($target ?? 10000000) }}</span>
                    </p>
                    <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Progress</span>
                </div>
            </div>
        </div>
    </div>
</x-filament::section>

@script
<script>
    let chartTwoInstance = null;

    function renderChart() {
        const chartEl = document.querySelector("#chartTwo");
        if (!chartEl) return;

        const progress = parseFloat(chartEl.dataset.progress) || 0;
        const current = parseFloat(chartEl.dataset.current) || 0;
        const target = parseFloat(chartEl.dataset.target) || 0;

        // Dynamic color palette
        let color = "#6366F1"; // Filament indigo
        let trend = "+ Stable";

        if (progress >= 100) { color = "#22C55E"; trend = "+ Excellent!"; }
        else if (progress >= 80) { color = "#3B82F6"; trend = "+ On Track"; }
        else if (progress >= 50) { color = "#EAB308"; trend = "~ Improving"; }
        else { color = "#EF4444"; trend = "Needs Work"; }

        // Update badge and text
        const badge = document.getElementById("indicatorBadge");
        const trendText = document.getElementById("trendText");
        badge.style.backgroundColor = color + "1A";
        badge.style.color = color;
        trendText.textContent = trend;

        const indicatorVal = document.getElementById("indicatorValue");
        indicatorVal.textContent = Math.round(progress) + "%";

        // Recreate chart cleanly
        if (chartTwoInstance) chartTwoInstance.destroy();

        const isDark = document.documentElement.classList.contains("dark");
        const trackBg = isDark ? "rgba(55, 65, 81, 0.4)" : "rgba(229, 231, 235, 0.6)";
        const textColor = isDark ? "#F9FAFB" : "#111827";

        const chartOptions = {
            series: [progress],
            chart: {
                type: "radialBar",
                height: 280,
                animations: { enabled: true, easing: "easeinout", speed: 1200 },
                sparkline: { enabled: true },
            },
            colors: [color],
            plotOptions: {
                radialBar: {
                    startAngle: -110,
                    endAngle: 110,
                    hollow: {
                        size: "70%",
                        background: "transparent",
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            blur: 6,
                            opacity: 0.2,
                        },
                    },
                    track: {
                        background: trackBg,
                        strokeWidth: "85%",
                    },
                    dataLabels: {
                        show: false,
                    },
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: [color],
                    stops: [0, 100],
                },
            },
            stroke: {
                lineCap: "round",
            },
        };

        chartTwoInstance = new ApexCharts(chartEl, chartOptions);
        chartTwoInstance.render();
    }

    // Render chart
    renderChart();

    // Auto re-render on theme or Livewire changes
    document.addEventListener("livewire:navigated", renderChart);
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', renderChart);
</script>
@endscript
