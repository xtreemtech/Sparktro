<script setup>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip } from 'chart.js'
import { ref } from 'vue'

// Register Chart.js elements and plugins
ChartJS.register(ArcElement, Tooltip)

// Data for the browsers and chart
const browsers = [
    { name: 'Firefox', value: 24687285, color: '#453d81' },
    { name: 'Chrome', value: 13456211, color: '#b0c5e7' },
    { name: 'Edge', value: 8347622, color: '#a7d4c6' },
    { name: 'Opera', value: 4928321, color: '#bfcaf2' }
]

// Reactive state for the currently hovered browser and tooltip position
const activeBrowser = ref(null)
const tooltipPosition = ref({ x: 0, y: 0 })

// Chart data configuration for vue-chartjs Doughnut component
const chartData = {
    labels: browsers.map(b => b.name),
    datasets: [{
        data: browsers.map(b => b.value),
        backgroundColor: browsers.map(b => b.color),
        borderWidth: 0,
        borderRadius: 4,
        hoverBorderWidth: 2,
        hoverBorderColor: '#fff',
        hoverOffset: 4
    }]
}

// Chart options configuration for vue-chartjs Doughnut component
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '65%', // Defines the size of the inner hole for a doughnut chart
    plugins: {
        legend: { display: false }, // Hide default legend as we're creating a custom one
        tooltip: { enabled: false } // Disable Chart.js's default tooltip to use our custom one
    }
}

/**
 * Handles mouse movement over the chart canvas to show a custom tooltip.
 * @param {object} event - The chart event object from vue-chartjs.
 */
const handleChartMouseMove = (event) => {
    const chart = event.chart // The Chart.js instance
    // Get elements at the current event position (mouse cursor)
    const elements = chart.getElementsAtEventForMode(
        event.event, // The raw DOM event
        'nearest',   // Mode to select elements
        { intersect: true }, // Whether to intersect with the element
        false        // Don't use internal tooltips
    )

    if (elements.length > 0) {
        const index = elements[0].index // Get the index of the hovered segment
        activeBrowser.value = browsers[index] // Set the active browser data

        // Calculate tooltip position relative to the chart canvas
        const canvasRect = chart.canvas.getBoundingClientRect()
        tooltipPosition.value = {
            x: event.event.clientX - canvasRect.left, // Mouse X relative to canvas
            y: event.event.clientY - canvasRect.top   // Mouse Y relative to canvas
        }
    } else {
        activeBrowser.value = null // No segment hovered, hide tooltip
    }
}

/**
 * Handles mouse leaving the chart canvas to hide the custom tooltip.
 */
const handleChartMouseOut = () => {
    activeBrowser.value = null
}

/**
 * Formats a number with locale-specific thousands separators.
 * @param {number} num - The number to format.
 * @returns {string} The formatted number string.
 */
const formatNumber = (num) => {
    return num.toLocaleString()
}
</script>

<template>
    <div class="bg-white rounded-xl p-4 flex flex-col h-full border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Browse Status</h2>
            <button class="p-1 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                </svg>
            </button>
        </div>

        <div class="relative flex-1 flex items-center justify-center">
            <!-- Doughnut Chart Component -->
            <Doughnut
                :data="chartData"
                :options="chartOptions"
                @chart:mousemove="handleChartMouseMove"
                @chart:mouseout="handleChartMouseOut"
            />

            <!-- Floating Text Tooltip (Custom Hover Effect) -->
            <div
                v-if="activeBrowser"
                class="absolute bg-black bg-opacity-75 text-white rounded-lg p-3 border border-gray-700 pointer-events-none z-10 whitespace-nowrap"
                :style="{
                    left: `${tooltipPosition.x}px`,
                    top: `${tooltipPosition.y}px`,
                    transform: 'translate(-50%, -110%)', /* Adjust Y for better positioning above cursor */
                    minWidth: '120px'
                }"
            >
                <div class="text-lg font-semibold text-center">
                    {{ activeBrowser.name }}
                </div>
                <div class="text-sm text-center">
                    {{ formatNumber(activeBrowser.value) }}
                </div>
            </div>
        </div>

        <!-- Browser List - Horizontal with dots beside text -->
        <div class="flex justify-between mt-6 px-2">
            <div
                v-for="(browser, index) in browsers"
                :key="index"
                class="flex items-center"
            >
                <span
                    class="w-2 h-2 rounded-full mr-2"
                    :style="{ backgroundColor: browser.color }"
                ></span>
                <span class="text-xs text-gray-600">{{ browser.name }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Remove shadow from main container (if applied globally elsewhere) */
.bg-white {
    box-shadow: none; /* Ensure no conflicting shadows */
}

/* Vertical three-dot menu icon (if needed) */
svg {
    display: block;
}

/* Smooth transition for the tooltip positioning */
.absolute {
    transition: left 0.05s ease-out, top 0.05s ease-out; /* Faster transition for smoother follow */
}
</style>
