import ApexScharts from "apexcharts";

console.log(typeof ApexCharts);

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

    if (progress >= 100) {
        color = "#22C55E";
        trend = "+ Excellent!";
    } else if (progress >= 80) {
        color = "#3B82F6";
        trend = "+ On Track";
    } else if (progress >= 50) {
        color = "#EAB308";
        trend = "~ Improving";
    } else {
        color = "#EF4444";
        trend = "Needs Work";
    }

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
    const trackBg = isDark
        ? "rgba(55, 65, 81, 0.4)"
        : "rgba(229, 231, 235, 0.6)";
    const textColor = isDark ? "#F9FAFB" : "#111827";

    const chartOptions = {
        series: [progress],
        chart: {
            type: "radialBar",
            height: 280,
            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 1200,
            },
            sparkline: {
                enabled: true,
            },
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
document.addEventListener("livewire:initialized", renderChart);

// Auto re-render on theme or Livewire changes
document.addEventListener("livewire:navigated", renderChart);
window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", renderChart);
