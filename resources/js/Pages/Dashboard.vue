 dashboard.vue

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head } from "@inertiajs/vue3";



import TopMetrics from "@/Components/TopMetrics.vue";

import RevenueChart from "@/Components/Charts/RevenueChart.vue";

import SalesChart from "@/Components/Charts/SalesChart.vue";

import CalendarSchedule from "@/Components/CalendarSchedule.vue";

import BrowseStatus from "@/Components/BrowseStatus.vue";

import TaskStatus from "@/Components/TaskStatus.vue";

import NewCustomers from "@/Components/NewCustomers.vue";

import RecentOrders from "@/Components/RecentOrders.vue";

</script>



<template>

  <Head title="Dashboard" />



  <AuthenticatedLayout>

    <template #header>

      <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>

    </template>



    <section class="py-8">

      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

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