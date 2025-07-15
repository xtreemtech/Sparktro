<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

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


// function handleImageChange(event) {
//     form.image = event.target.files[0]
// }


// Submit form
function onSubmit() {
    form.post('/users/store', {
        form: true,
        onSuccess: () => {

            // optional: reset form or show success
            form.reset()
        }
    })
}

</script>

<template>

    <Head title="Create User" />

    <AuthenticatedLayout>

        <div class="p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div
                    class="flex flex-col md:flex-row items-center justify-between px-6 py-6 border-b border-gray-200 bg-gray-50 space-y-2 md:space-y-0">

                    <h2 class="text-lg font-semibold text-gray-800">Create New User</h2>
                    <div>
                        <Link href="/users/all" class="px-4 py-2 bg-white text-sm rounded text-gray-800">
                        ✕ Cancel
                        </Link>
                    </div>
                </div>

                <div class="p-6">

                    <!-- Form -->
                    <form class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm" @submit.prevent="onSubmit()">
                        <!-- Row 1 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">User Name</label>
                            <input type="text" v-model="form.username" placeholder="User Name"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">User ID</label>
                            <input type="text" v-model="form.user_id" placeholder="User ID"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Email</label>
                            <input type="email" v-model="form.email" placeholder="example@gmail.com"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>

                        <!-- Row 2 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Phone</label>
                            <input type="text" v-model="form.phone" placeholder="Phone Number"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Joining Date</label>
                            <input type="date" v-model="form.join_date"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Country</label>
                            <select v-model="form.country"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
                                <option>Select Country</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                            </select>
                        </div>

                        <!-- Row 3 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Language</label>
                            <select v-model="form.language"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
                                <option>Select Language</option>
                                <option value="English">English</option>
                                <option value="Bangla">Bangla</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Address</label>
                            <input type="text" v-model="form.address" placeholder="Address"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Gender</label>
                            <select v-model="form.gender"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
                                <option>Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <!-- Row 4 -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Department</label>
                            <select v-model="form.department"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
                                <option>Select Department</option>
                                <option>Management</option>
                                <option>Accounts</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Designation</label>
                            <select v-model="form.designation"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
                                <option>Designation</option>
                                <option>Manager</option>
                                <option>Developer</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Role</label>
                            <select v-model="form.role"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
                                <option>Select Role</option>
                                <option>Admin</option>
                                <option>Staff</option>
                            </select>
                        </div>

                        <!-- Row 5 -->
                        <!-- <div>
                            <label class="block text-xs font-semibold mb-1">User Image (100px*100px)</label>
                            <input type="file" @change="handleImageChange"
                                class="w-full border rounded px-2 py-1 text-gray-600 file:bg-gray-100 file:border file:rounded file:px-2 file:py-1 file:text-sm file:text-gray-600" />
                        </div> -->
                        <div>
                            <label class="block text-xs font-semibold mb-1">Duty Schedule</label>
                            <input type="text" v-model="form.duty_schedule" placeholder="Duty Schedule"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Password</label>
                            <input type="password" v-model="form.password" placeholder="Password"
                                class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
                        </div>


                        <div class="flex justify-start mt-4">
                            <button type="submit" class="px-4 py-2 bg-teal text-sm rounded text-white">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>