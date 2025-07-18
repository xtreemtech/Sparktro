<template>
  <div class="bg-white rounded-xl p-4 shadow-sm flex flex-col justify-between h-full">
    <!-- Header -->
    <div class="flex justify-between items-center mb-3">
      <h2 class="text-lg font-semibold text-gray-800">Task Status</h2>
      <button class="p-1 rounded-md hover:bg-gray-100 text-gray-500">
        <span class="block w-1 h-1 rounded-full bg-current mb-0.5"></span>
        <span class="block w-1 h-1 rounded-full bg-current mb-0.5"></span>
        <span class="block w-1 h-1 rounded-full bg-current"></span>
      </button>
    </div>

    <!-- Chart -->
    <div class="mb-4">
      <apexchart
        width="100%"
        height="120"
        type="area"
        :options="chartOptions"
        :series="series"
      />
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-3 divide-x divide-gray-200 text-center pt-2 mb-4">
      <div>
        <p class="text-xl font-semibold text-blue-600 leading-tight">982</p>
        <p class="text-sm text-gray-600 mt-1">Complete Task</p>
      </div>
      <div>
        <p class="text-xl font-semibold text-yellow-500 leading-tight">126</p>
        <p class="text-sm text-gray-600 mt-1">Pending Task</p>
      </div>
      <div>
        <p class="text-xl font-semibold text-red-500 leading-tight">65</p>
        <p class="text-sm text-gray-600 mt-1">Due Task</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import ApexCharts from 'vue3-apexcharts'

const series = [
  {
    name: 'Task Flow',
    data: [20, 35, 30, 50, 45, 55, 48, 60, 52, 64, 50, 68],
  },
]

const chartOptions = {
  chart: {
    type: 'area',
    toolbar: { show: false },
    zoom: { enabled: false },
    sparkline: { enabled: true },
  },
  stroke: {
    curve: 'smooth',
    width: 2,
    colors: ['#10B981'], // Tailwind green-500
  },
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.6,
      opacityTo: 0,
      stops: [0, 100],
      colorStops: [],
    },
    colors: ['#6EE796'], // light green-300
  },
  tooltip: {
    theme: 'dark',
    x: { show: false },
    y: {
      formatter: (val) => `${val} tasks`,
    },
  },
  grid: { show: false },
  dataLabels: { enabled: false },
  markers: { size: 0 },
  xaxis: { labels: { show: false }, axisBorder: { show: false }, axisTicks: { show: false } },
  yaxis: { show: false },
}
</script>
