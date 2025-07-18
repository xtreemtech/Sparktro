<script setup>
import { Head } from "@inertiajs/vue3";
// Correct path to your AuthenticatedLayout.vue
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"; 
import TopMetrics from "@/Components/Charts/TopMetrics.vue";
import TaskStatus from "@/Components/Charts/TaskStatus.vue";
import RevenueChart from "@/Components/Charts/RevenueChart.vue";
import SalesChart from "@/Components/Charts/SalesChart.vue";
import BrowseStatus from "@/Components/Charts/BrowseStatus.vue";
import CalendarSchedule from "@/Components/Calendar/CalendarSchedule.vue";
import RecentOrders from "@/Components/UserManagement/RecentOrders.vue";
import NewCustomers from "@/Components/UserManagement/NewCustomers.vue";

</script>

<template>
  <AuthenticatedLayout>
    <Head title="Dashboard" />
    <section class="py-8">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h2>
        <TopMetrics />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <RevenueChart />
          <SalesChart />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <CalendarSchedule />
          <BrowseStatus />
          <TaskStatus />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
          <RecentOrders />
          <NewCustomers />
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>