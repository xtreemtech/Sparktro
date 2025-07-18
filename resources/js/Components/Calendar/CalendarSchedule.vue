<template>
  <div class="bg-white rounded-xl p-4 shadow-sm h-full">
    <div class="flex justify-between items-start mb-4">
      <h2 class="text-lg font-semibold text-gray-800">Calendar Schedule</h2>
      <button class="p-1 flex flex-col items-center justify-center rounded-md hover:bg-gray-50 text-gray-500">
        <span class="block w-1 h-1 rounded-full bg-current mb-0.5"></span>
        <span class="block w-1 h-1 rounded-full bg-current mb-0.5"></span>
        <span class="block w-1 h-1 rounded-full bg-current"></span>
      </button>
    </div>

    <div class="flex items-center justify-between text-sm font-medium text-gray-700 mb-4">
      <button @click="prevMonth" class="p-1 rounded hover:bg-gray-100">
        <span>&larr;</span>
      </button>
      <div>{{ currentMonthYear }}</div>
      <button @click="nextMonth" class="p-1 rounded hover:bg-gray-100">
        <span>&rarr;</span>
      </button>
    </div>

    <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-gray-400 mb-2">
      <div v-for="day in weekDays" :key="day">{{ day }}</div>
    </div>

    <div class="grid grid-cols-7 gap-1 text-sm text-gray-800">
      <div
        v-for="(day, index) in paddedDays"
        :key="index"
        class="aspect-square flex items-center justify-center rounded-md"
        :class="{
          'text-gray-300': day.isPadding,
          'bg-blue-100 text-blue-700 font-semibold': isToday(day.date)
        }"
      >
        {{ day.label }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const today = new Date()
const currentDate = ref(new Date())

const weekDays = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']

const currentMonthYear = computed(() =>
  currentDate.value.toLocaleDateString('en-US', {
    month: 'long',
    year: 'numeric'
  })
)

function getDaysInMonth(year, month) {
  return new Date(year, month + 1, 0).getDate()
}

function getStartDayOfMonth(year, month) {
  let day = new Date(year, month, 1).getDay()
  return (day + 6) % 7 // Adjust so Monday is first
}

const paddedDays = computed(() => {
  const year = currentDate.value.getFullYear()
  const month = currentDate.value.getMonth()
  const daysInMonth = getDaysInMonth(year, month)
  const startDay = getStartDayOfMonth(year, month)

  const days = []

  // padding before
  for (let i = 0; i < startDay; i++) {
    days.push({ label: '', isPadding: true, date: null })
  }

  // actual days
  for (let d = 1; d <= daysInMonth; d++) {
    days.push({
      label: d,
      isPadding: false,
      date: new Date(year, month, d)
    })
  }

  return days
})

function isToday(date) {
  if (!date) return false
  return (
    date.getDate() === today.getDate() &&
    date.getMonth() === today.getMonth() &&
    date.getFullYear() === today.getFullYear()
  )
}

function prevMonth() {
  currentDate.value = new Date(
    currentDate.value.getFullYear(),
    currentDate.value.getMonth() - 1,
    1
  )
}

function nextMonth() {
  currentDate.value = new Date(
    currentDate.value.getFullYear(),
    currentDate.value.getMonth() + 1,
    1
  )
}
</script>

<style scoped>
</style>
