<template>
  <div class="relative w-full h-full">
    <!-- Custom Tooltip Overlay -->
    <div 
      v-if="hoveredIndex !== null" 
      class="absolute z-10 px-3 py-2 bg-black bg-opacity-70 text-white text-sm rounded-lg pointer-events-none"
      :style="{
        left: `${tooltipPosition.x}px`,
        top: `${tooltipPosition.y}px`,
        transform: 'translate(-50%, -120%)',
        transition: 'all 0.1s ease'
      }"
    >
      <div class="text-sm font-semibold">{{ labels[hoveredIndex] }}</div>
      <div class="text-xs">{{ formatNumber(data[hoveredIndex]) }}</div>
    </div>

    <!-- Chart -->
    <div class="w-full h-full">
      <Doughnut
        :data="chartData"
        :options="chartOptions"
        @chart:mousemove="handleChartMouseMove"
        @chart:mouseout="clearHover"
      />
    </div>
  </div>
</template>

<script setup>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip } from 'chart.js'
import { ref } from 'vue'

ChartJS.register(ArcElement, Tooltip)

const props = defineProps({
  data: Array,
  labels: Array,
  backgroundColors: Array
})

const hoveredIndex = ref(null)
const tooltipPosition = ref({ x: 0, y: 0 })

const chartData = {
  labels: props.labels,
  datasets: [{
    data: props.data,
    backgroundColor: props.backgroundColors,
    borderWidth: 0,
    borderRadius: 4,
    hoverBorderWidth: 2,
    hoverBorderColor: '#fff',
    hoverOffset: 6
  }]
}

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  cutout: '65%',
  plugins: {
    legend: { display: false },
    tooltip: {
      enabled: false
    }
  }
}

function handleChartMouseMove(event) {
  const chart = event.chart
  const elements = chart.getElementsAtEventForMode(event.event, 'nearest', { intersect: true }, false)

  if (elements.length > 0) {
    const i = elements[0].index
    hoveredIndex.value = i

    const canvasBounds = event.event.target.getBoundingClientRect()
    tooltipPosition.value = {
      x: event.event.clientX - canvasBounds.left,
      y: event.event.clientY - canvasBounds.top
    }
  } else {
    hoveredIndex.value = null
  }
}

function clearHover() {
  hoveredIndex.value = null
}

function formatNumber(n) {
  return n.toLocaleString()
}
</script>
