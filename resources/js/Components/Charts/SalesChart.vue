<template>
  <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-gray-900">Sales</h2>

      <div class="flex items-center gap-4">
        <!-- Custom Chart Legend -->
        <div class="flex items-center gap-3">
          <div
            v-for="(serie, index) in series"
            :key="index"
            @click="toggleSeries(serie.name)"
            class="flex items-center cursor-pointer"
          >
            <span
              class="w-3 h-3 rounded-full mr-1"
              :style="{ backgroundColor: chartOptions.colors[index] }"
            ></span>
            <span class="text-sm text-gray-600">{{ serie.name }}</span>
          </div>
        </div>

        <!-- Dropdown - Fixed arrow -->
        <div class="relative w-32">
          <select
            v-model="selectedPeriod"
            class="block w-full text-sm border border-gray-300 rounded px-3 py-1 pr-8 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-none"
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
      type="bar"
      height="300"
      :options="chartOptions"
      :series="series"
      ref="chartRef"
    />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import ApexChart from "vue3-apexcharts";

const series = ref([
  {
    name: "Sales",
    data: [0.82, 0.38, 0.89, 0.62, 0.32, 0.79, 0.19, 0.40, 0.58, 0.80, 0.38, 0.62]
  },
  {
    name: "Order",
    data: [0.38, 0.82, 0.62, 0.89, 0.79, 0.32, 0.40, 0.19, 0.80, 0.58, 0.62, 0.38]
  }
]);

const chartOptions = computed(() => ({
  chart: {
    id: 'sales-bar-chart',
    type: 'bar',
    toolbar: { show: false },
    zoom: { enabled: false },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded',
      borderRadius: 5,
    },
  },
  dataLabels: { enabled: false },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  colors: ['#A7D4C6', '#8796C8'],
  xaxis: {
    categories: [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun",
      "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
    ],
    axisBorder: { show: false },
    axisTicks: { show: false },
    labels: {
      style: {
        colors: '#6B7280',
        fontSize: '12px',
        fontFamily: 'Work Sans, sans-serif'
      }
    }
  },
  yaxis: {
    labels: {
      formatter: (val) => `$${val.toFixed(2)}`,
      style: {
        colors: '#6B7280',
        fontSize: '12px',
        fontFamily: 'Work Sans, sans-serif'
      }
    },
    min: 0,
    max: 1
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    enabled: true,
    shared: true,
    intersect: false,
    y: {
      formatter: function (val) {
        const actualValue = val * 100000;
        return `$${actualValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      }
    },
    marker: {
      show: true,
    },
    custom: function({ series, seriesIndex, dataPointIndex, w }) {
      const primaryValue = series[0][dataPointIndex] * 100000;
      const secondaryValue = series[1][dataPointIndex] * 100000;
      const primaryColor = w.config.colors[0];
      const secondaryColor = w.config.colors[1];

      return '<div class="apexcharts-tooltip-custom">' +
        '<div class="flex items-center text-xs mb-1">' +
          `<span class="w-2 h-2 rounded-full mr-1" style="background-color: ${primaryColor};"></span>` +
          `<span>$${primaryValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span>` +
        '</div>' +
        '<div class="flex items-center text-xs">' +
          `<span class="w-2 h-2 rounded-full mr-1" style="background-color: ${secondaryColor};"></span>` +
          `<span>${secondaryValue.toLocaleString()}</span>` +
        '</div>' +
        '</div>';
    }
  },
  grid: {
    show: true,
    borderColor: '#E5E7EB',
    strokeDashArray: 0,
    position: 'back',
    xaxis: {
      lines: {
        show: false
      }
    },
    yaxis: {
      lines: {
        show: true
      }
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  },
  legend: {
    show: false,
  },
}));

const chartRef = ref(null);
const selectedPeriod = ref('May 2025');

const toggleSeries = (seriesName) => {
  if (chartRef.value) {
    chartRef.value.toggleSeries(seriesName);
  }
};
</script>

<style scoped>
/* Remove default dropdown styling */
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

/* Custom tooltip styling */
:deep(.apexcharts-tooltip-custom) {
  background: #333;
  color: #fff;
  padding: 8px 12px;
  border-radius: 6px;
  font-size: 12px;
  line-height: 1.5;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  font-family: 'Work Sans', sans-serif;
}

:deep(.apexcharts-tooltip-custom .w-2.h-2.rounded-full) {
  display: inline-block;
  vertical-align: middle;
  margin-right: 6px;
}
</style>