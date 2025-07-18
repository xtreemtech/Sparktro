<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    metrics: {
        type: Array,
        required: false,
        default: () => [
            { id: 1, title: 'Total Employees', value: '18', change: '+46.08%', icon: 'group', changeType: 'increase' },
            { id: 2, title: 'Total Seller', value: '04', change: '-0.02%', icon: 'account_box', changeType: 'decrease' },
            { id: 3, title: 'Total Expenses', value: '$365.54', change: '+46.08%', icon: 'money_off', changeType: 'increase' },
            { id: 4, title: 'Total Deposits', value: '$0.00', change: '+46.08%', icon: 'savings', changeType: 'increase' },
            { id: 5, title: 'Total Product', value: '9587', change: '-0.03%', icon: 'shopping_bag', changeType: 'decrease' },
            { id: 6, title: 'Total Tasks', value: '12', change: '+46.08%', icon: 'list_alt', changeType: 'increase' },
            { id: 7, title: 'Total Order', value: '64', change: '+46.08%', icon: 'shopping_cart', changeType: 'increase' },
            { id: 8, title: 'Total Sale', value: '$654.57', change: '+46.08%', icon: 'attach_money', changeType: 'increase' },
            { id: 9, title: 'Total Refunded', value: '$9124.25', change: '-0.02%', icon: 'history', changeType: 'decrease' },
            { id: 10, title: 'Total Revenue', value: '$265.35', change: '+46.08%', icon: 'trending_up', changeType: 'increase' },
            { id: 11, title: 'New Customer', value: '842', change: '+6.08%', icon: 'person_add', changeType: 'increase' },
            { id: 12, title: 'Pending Order', value: '64', change: '-0.02%', icon: 'timer', changeType: 'decrease' },
        ]
    }
});
</script>

<template>
    <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 mb-6">
        <div v-for="metric in metrics" :key="metric.id"
            class="bg-white p-5 rounded-lg border border-gray-100 shadow-xs flex flex-col">
            <div class="flex items-center mb-3">
                <i class="material-icons-round text-gray-500 text-xl mr-2">{{ metric.icon }}</i>
                <p class="text-sm font-medium text-gray-600">{{ metric.title }}</p>
            </div>
            <p class="text-2xl font-bold text-gray-900 mb-1">{{ metric.value }}</p>
            <div class="flex items-center text-xs"
                :class="{ 
                    'text-green-500': metric.changeType === 'increase', 
                    'text-red-500': metric.changeType === 'decrease' 
                }">
                <span>{{ metric.change }}</span>
                <i v-if="metric.changeType === 'increase'" class="material-icons-round text-sm ml-1">arrow_upward</i>
                <i v-else-if="metric.changeType === 'decrease'" class="material-icons-round text-sm ml-1">arrow_downward</i>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Using Material Icons Round as shown in Figma */
@import url('https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200');

.material-icons-round {
    font-family: 'Material Symbols Rounded';
    font-weight: normal;
    font-style: normal;
    font-size: 20px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
    font-variation-settings: 'FILL' 1, 'GRAD' 0, 'opsz' 20;
}

.border-gray-100 {
    border-color: #F3F4F6;
}

.shadow-xs {
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
}

.text-gray-600 {
    color: #4B5563;
}

.text-gray-900 {
    color: #111827;
}

.text-green-500 {
    color: #10B981;
}

.text-red-500 {
    color: #EF4444;
}

/* Responsive adjustments */
@media (max-width: 639px) {
    .grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 12px;
    }
    .p-5 {
        padding: 16px;
    }
}

@media (max-width: 400px) {
    .grid {
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    }
}
</style>