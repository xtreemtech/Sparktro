<template>
  <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-gray-900">Revenue</h2>

      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
        <!-- Custom Legend - Grey background removed -->
        <div class="flex flex-wrap items-center gap-3">
          <div
            v-for="(serie, index) in seriesData"
            :key="index"
            @click="toggleSeries(index)"
            @mouseover="highlightSeries(index, true)"
            @mouseleave="highlightSeries(index, false)"
            class="flex items-center cursor-pointer transition-all duration-150"
            :class="{
              'opacity-60': !activeSeries[index],
              'hover:opacity-100': true
            }"
          >
            <span
              class="w-3 h-3 rounded-full mr-2"
              :style="{ backgroundColor: chartOptions.colors[index] }"
            ></span>
            <span class="text-xs font-medium text-gray-700">{{ serie.name }}</span>
          </div>
        </div>

        <!-- Period Dropdown - Fixed double arrow -->
        <div class="relative w-32">
          <select
            v-model="selectedPeriod"
            class="block w-full text-sm border border-gray-300 rounded px-3 py-1 pr-8 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-none"
          >
            <option value="May 2025">May 2025</option>
            <option value="Apr 2025">Apr 2025</option>
            <option value="Mar 2025">Mar 2025</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
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
      :series="filteredSeries"
      ref="chart"
    />
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const chart = ref(null);
const selectedPeriod = ref("May 2025");
const activeSeries = ref([true, true]);

const seriesData = [
  {
    name: "Revenue",
    data: [0.2, 0.3, 0.35, 0.4, 0.6, 0.78, 0.85, 0.9, 0.88, 0.92, 0.87, 0.89],
  },
  {
    name: "Expenses",
    data: [0.18, 0.22, 0.26, 0.3, 0.42, 0.55, 0.61, 0.68, 0.7, 0.74, 0.76, 0.78],
  },
];

const filteredSeries = computed(() =>
  seriesData.map((serie, index) => ({
    ...serie,
    data: activeSeries.value[index]
      ? serie.data
      : serie.data.map(() => null),
  }))
);

const toggleSeries = (index) => {
  activeSeries.value[index] = !activeSeries.value[index];
  if (chart.value) {
    chart.value.updateSeries(
      [
        {
          data: activeSeries.value[index]
            ? seriesData[index].data
            : seriesData[index].data.map(() => null),
        },
      ],
      false,
      index
    );
  }
};

const highlightSeries = (index, highlight) => {
  if (chart.value) {
    chart.value.highlightSeries(index, highlight);
  }
};

const chartOptions = {
  chart: {
    toolbar: { show: false },
    zoom: { enabled: false },
    animations: {
      enabled: true,
      easing: "easeinout",
      speed: 800,
    },
  },
  colors: ["#3E82F7", "#28C76F"],
  dataLabels: { enabled: false },
  stroke: {
    curve: "smooth",
    width: 2,
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
    show: false,
  },
};
</script>

<style scoped>
/* Remove default dropdown styling completely */
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-image: none;
  background-color: transparent;
}
select::-ms-expand {
  display: none;
}

/* Custom legend item styling */
.flex.items-center.cursor-pointer {
  padding: 0.25rem 0.5rem;
}
</style>