<template>
  <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-sparktro">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-black-sparktro">Revenue</h2>

      <div class="flex items-center gap-4">
        <!-- Chart Legend Container (will be populated by ApexCharts) -->
        <div id="custom-legend" class="flex items-center gap-3"></div>

        <!-- Dropdown -->
        <div class="relative">
          <select
            class="appearance-none text-sm border border-gray-300 rounded px-3 py-1 pr-8 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option>May 2025</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-500">
            <svg
              class="w-4 h-4"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
              />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <apexchart
      type="area"
      height="300"
      :options="chartOptions"
      :series="series"
      @legendClick="handleLegendClick"
      ref="chart"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import VueApexCharts from "vue3-apexcharts";

defineOptions({ components: { apexchart: VueApexCharts } });

const chart = ref(null);

const series = ref([
  {
    name: "Revenue",
    data: [0.2, 0.3, 0.35, 0.4, 0.6, 0.78, 0.85, 0.9, 0.88, 0.92, 0.87, 0.89],
  },
  {
    name: "Expenses",
    data: [
      0.18, 0.22, 0.26, 0.3, 0.42, 0.55, 0.61, 0.68, 0.7, 0.74, 0.76, 0.78,
    ],
  },
]);

const chartOptions = ref({
  chart: {
    toolbar: { show: false },
    zoom: { enabled: false },
    events: {
      mounted: (chartContext, config) => {
        moveLegendToHeader(chartContext);
      },
      updated: (chartContext, config) => {
        moveLegendToHeader(chartContext);
      },
    },
  },
  colors: ["#3E82F7", "#28C76F"],
  dataLabels: { enabled: false },
  stroke: {
    curve: "smooth",
    width: 2,
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.4,
      opacityTo: 0.1,
      stops: [0, 90, 100],
    },
  },
  xaxis: {
    categories: [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
    ],
  },
  yaxis: {
    labels: {
      formatter: (val) => `$${val.toFixed(2)}`,
    },
  },
  tooltip: {
    y: {
      formatter: (val) => `$${(val * 10000).toFixed(2)}`,
    },
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'right',
    offsetY: -10,
    markers: {
      width: 10,
      height: 10,
      radius: 2,
    },
    itemMargin: {
      horizontal: 10,
      vertical: 0
    },
  },
});

const moveLegendToHeader = (chartContext) => {
  const legend = chartContext.el.querySelector('.apexcharts-legend');
  if (legend) {
    document.getElementById('custom-legend').appendChild(legend);
    // Adjust legend position
    legend.style.position = 'relative';
    legend.style.top = '0';
    legend.style.right = '0';
    legend.style.transform = 'none';
  }
};

const handleLegendClick = (chartContext, seriesIndex, config) => {
  // This maintains the default legend click behavior
  chart.value.toggleSeries(seriesIndex);
};
</script>

<style scoped>
/* Style the legend items */
:deep(.apexcharts-legend) {
  padding: 0 !important;
  margin: 0 !important;
  position: static !important;
}

:deep(.apexcharts-legend-series) {
  margin: 0 10px 0 0 !important;
  display: flex;
  align-items: center;
}

:deep(.apexcharts-legend-marker) {
  margin-right: 6px !important;
}

:deep(.apexcharts-legend-text) {
  font-size: 12px !important;
  color: #6B7280 !important;
  font-family: 'Inter', sans-serif !important;
}

@media (max-width: 640px) {
  .flex.items-center.gap-4 {
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
  }
}
</style>