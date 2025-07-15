<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    customers: Object,
});

</script>

<template>
    <Head title="Customer List" />

    <AuthenticatedLayout>
        <div class="p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col md:flex-row items-center justify-between px-6 py-6 border-b border-gray-200 bg-gray-50 space-y-2 md:space-y-0">
                    
                    <h2 class="text-lg font-semibold text-gray-800">Customer List</h2>
                    <div>
                        <Link href="/users/create" class="px-4 py-2 bg-teal text-sm rounded text-white">
                            + Add User
                        </Link>
                    </div>

                    <!-- <div class="flex items-center gap-2">

                        <select class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="10">Show 10</option>
                            <option value="25">Show 25</option>
                            <option value="50">Show 50</option>
                        </select>

                        <input
                            type="text"
                            placeholder="Search"
                            class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500"
                        />                        
                    </div> -->
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3"><input type="checkbox" /></th>
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Customer Name</th>
                                <th class="px-4 py-3">Phone</th>
                                <th class="px-4 py-3">Country</th>
                                <th class="px-4 py-3">Department</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="customer in customers" :key="customer.id" class="hover:bg-gray-50">
                                <td class="px-4 py-3"><input type="checkbox" /></td>

                                <td class="px-4 py-3">
                                    <img :src="customer.image" alt="avatar" class="w-8 h-8 rounded-full object-cover" />
                                </td>

                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-800">{{ customer.name }}</div>
                                    <div class="text-xs text-gray-500">{{ customer.email }}</div>
                                </td>

                                <td class="px-4 py-3">{{ customer.phone }}</td>                                
                                <td class="px-4 py-3">{{ customer.country }}</td>
                                <td class="px-4 py-3">{{ customer.department }}</td>
                                <td class="px-4 py-3">{{ customer.date }}</td>
                                <td class="px-4 py-3">{{ customer.role }}</td>
                                <td class="px-4 py-3">{{ customer.status }}</td>
                                <td class="px-4 py-3 text-right">
                                    <button class="text-gray-500 hover:text-gray-700">
                                        ⋮
                                    </button>
                                </td>

                                <!-- <td class="px-4 py-3">
                                    <span
                                        :class="customer.status === '1'
                                            ? 'bg-green-100 text-green-600'
                                            : 'bg-red-100 text-red-600'"
                                        class="px-2 py-0.5 rounded-full text-xs font-medium"
                                    >
                                        {{ customer.status }}
                                    </span>
                                </td> -->
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
