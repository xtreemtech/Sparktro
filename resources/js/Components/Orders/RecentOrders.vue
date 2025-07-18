<template>
  <div class="bg-white rounded-xl p-4 shadow-sm h-full">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
      <button class="text-sm text-blue-600 hover:underline">View All</button>
    </div>

    <ul class="space-y-3">
      <li v-for="order in orders" :key="order.id" class="flex items-center justify-between">
        <div>
          <p class="font-medium text-gray-700">{{ order.customer }}</p>
          <p class="text-xs text-gray-400">Order #{{ order.id }}</p>
        </div>
        <div class="text-sm text-gray-600">
          ${{ order.total.toFixed(2) }}
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
const orders = [
  { id: 1001, customer: "Jane Doe", total: 199.99 },
  { id: 1002, customer: "John Smith", total: 89.5 },
  { id: 1003, customer: "Alice Johnson", total: 340.0 },
  { id: 1004, customer: "Michael Lee", total: 120.25 }
]
</script>
