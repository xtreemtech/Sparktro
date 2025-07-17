<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    metrics: {
        type: Array,
        required: false, // Not strictly required if default data is always used
        default: () => [
            { id: 1, title: 'Total Employees', value: '18', change: '+6.08%', icon: 'group', changeType: 'increase' },
            { id: 2, title: 'Total Seller', value: '04', change: '-0.03%', icon: 'account_box', changeType: 'decrease' },
            { id: 3, title: 'Total Expenses', value: '$365.54', change: '+6.08%', icon: 'money_off', changeType: 'increase' },
            { id: 4, title: 'Total Deposits', value: '$0.00', change: '+6.08%', icon: 'savings', changeType: 'increase' },
            { id: 5, title: 'Total Product', value: '9587', change: '-0.03%', icon: 'shopping_bag', changeType: 'decrease' },
            { id: 6, title: 'Total Tasks', value: '12', change: '+6.08%', icon: 'list_alt', changeType: 'increase' },
            { id: 7, title: 'Total Order', value: '64', change: '+6.08%', icon: 'shopping_cart', changeType: 'increase' },
            { id: 8, title: 'Total Sale', value: '$654.57', change: '+6.08%', icon: 'attach_money', changeType: 'increase' },
            { id: 9, title: 'Total Refunded', value: '$9124.25', change: '-0.03%', icon: 'history', changeType: 'decrease' },
            { id: 10, title: 'Total Revenue', value: '$265.35', change: '+6.08%', icon: 'trending_up', changeType: 'increase' },
            { id: 11, title: 'New Customer', value: '842', change: '+6.08%', icon: 'person_add', changeType: 'increase' },
            { id: 12, title: 'Pending Order', value: '64', change: '-0.03%', icon: 'timer', changeType: 'decrease' },
        ]
    }
});
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 mb-6">
        <div v-for="metric in metrics" :key="metric.id"
            class="bg-white p-4 rounded-lg shadow-sm flex flex-col">
            <div class="flex items-center mb-2 text-gray-700">
                <i class="material-icons-outlined text-lg mr-1">{{ metric.icon }}</i>
                <p class="text-sm font-semibold">{{ metric.title }}</p>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ metric.value }}</p>
            <div class="flex items-center text-xs mt-1"
                :class="{ 'text-green-500': metric.changeType === 'increase', 'text-red-500': metric.changeType === 'decrease' }">
                <span>{{ metric.change }}</span>
                <i v-if="metric.changeType === 'increase'" class="material-icons-outlined text-green-500 text-sm ml-1">arrow_drop_up</i>
                <i v-else-if="metric.changeType === 'decrease'" class="material-icons-outlined text-red-500 text-sm ml-1">arrow_drop_down</i>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Ensure Material Icons Outlined is loaded globally (e.g., in app.css) */
@import url('https://fonts.googleapis.com/icon?family=Material+Icons+Outlined');

.material-icons-outlined {
    font-family: 'Material Icons Outlined';
    font-weight: normal;
    font-style: normal;
    font-size: 18px; /* Adjust size as needed */
    display: inline-block;
    line-height: 1;
    text-transform: none;
    letter-spacing: normal;
    word-wrap: normal;
    white-space: nowrap;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
    font-feature-settings: 'liga';
}
</style>
