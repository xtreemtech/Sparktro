<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
    image: null,
    username: '',
    user_id: '',
    email: '',
    phone: '',
    join_date: '',
    country: '',
    department: '',
    role: '',
    address: '',
    gender: '',
    languages: '',
    duty_schedule: '',
    password: '',
});

function onSubmit() {
    form.post('/users/store', {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.error('Error creating user:', errors);
        }
    });
}
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <div class="p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col md:flex-row items-center justify-between px-6 py-6 border-b border-gray-200 bg-gray-50 space-y-2 md:space-y-0">
                    <h2 class="text-lg font-semibold text-gray-800">Create New User</h2>
                    <div>
                        <Link 
                            href="/users/all" 
                            class="px-4 py-2 bg-white text-sm rounded text-gray-800 border border-gray-300 hover:bg-gray-50 transition-colors"
                        >
                            ✕ Cancel
                        </Link>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Form -->
                    <form class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm" @submit.prevent="onSubmit">
                        <!-- Row 1 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">User Name</label>
                            <input 
                                type="text" 
                                v-model="form.username" 
                                placeholder="User Name"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                            <div v-if="form.errors.username" class="text-red-500 text-xs mt-1">
                                {{ form.errors.username }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">User ID</label>
                            <input 
                                type="text" 
                                v-model="form.user_id" 
                                placeholder="User ID"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Email</label>
                            <input 
                                type="email" 
                                v-model="form.email" 
                                placeholder="example@gmail.com"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <!-- Row 2 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Phone</label>
                            <input 
                                type="text" 
                                v-model="form.phone" 
                                placeholder="Phone Number"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Joining Date</label>
                            <input 
                                type="date" 
                                v-model="form.join_date"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Country</label>
                            <select 
                                v-model="form.country"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select Country</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                            </select>
                        </div>

                        <!-- Row 3 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Language</label>
                            <select 
                                v-model="form.languages"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select Language</option>
                                <option value="English">English</option>
                                <option value="Bangla">Bangla</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Address</label>
                            <input 
                                type="text" 
                                v-model="form.address" 
                                placeholder="Address"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Gender</label>
                            <select 
                                v-model="form.gender"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Row 4 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Department</label>
                            <select 
                                v-model="form.department"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select Department</option>
                                <option value="Management">Management</option>
                                <option value="Accounts">Accounts</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Designation</label>
                            <select 
                                v-model="form.designation"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select Designation</option>
                                <option value="Manager">Manager</option>
                                <option value="Developer">Developer</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Role</label>
                            <select 
                                v-model="form.role"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>

                        <!-- Row 5 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Duty Schedule</label>
                            <input 
                                type="text" 
                                v-model="form.duty_schedule" 
                                placeholder="Duty Schedule"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Password</label>
                            <input 
                                type="password" 
                                v-model="form.password" 
                                placeholder="Password"
                                class="w-full border rounded px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <!-- Submit Button -->
                        <div class="md:col-span-3 flex justify-start mt-4">
                            <button 
                                type="submit" 
                                class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-sm rounded text-white transition-colors"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing">Creating...</span>
                                <span v-else>Create User</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>