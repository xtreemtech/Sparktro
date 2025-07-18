<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3'; // Added 'router' here
import EditUser from '@/Components/UserManagement/EditUser.vue';
import DeleteConfirmationModal from '@/Components/UserManagement/DeleteConfirmationModal.vue'; // Make sure this path is correct!

// User data (your existing data)
const users = ref([
  {
    id: 1,
    image: '/images/user1.jpg',
    name: 'Albert Flores',
    email: 'scs@netmail.com',
    phone: '(907) 555-0101',
    country: 'Saudi Arabia',
    department: 'Manager',
    date: '11 May 2025',
    role: 'Admin',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '123 Main St',
    gender: 'Male',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR001'
  },
  {
    id: 2,
    image: '/images/user2.jpg',
    name: 'Robert Fox',
    email: 'scs@netmail.com',
    phone: '(629) 555-0129',
    country: 'South Africa',
    department: 'Management',
    date: '11 May 2025',
    role: 'Super Admin',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '456 Oak Ave',
    gender: 'Male',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR002'
  },
  {
    id: 3,
    image: '/images/user3.jpg',
    name: 'Jenny Wilson',
    email: 'scs@netmail.com',
    phone: '(684) 555-0102',
    country: 'Viet Nam',
    department: 'Account',
    date: '11 May 2025',
    role: 'Staff',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '789 Pine Ln',
    gender: 'Female',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR003'
  },
  {
    id: 4,
    image: '/images/user4.jpg',
    name: 'Brooklyn Simmons',
    email: 'scs@netmail.com',
    phone: '(209) 555-0112',
    country: 'Bahrain',
    department: 'Developer',
    date: '11 May 2025',
    role: 'HR',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '101 Cedar Rd',
    gender: 'Female',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR004'
  },
  {
    id: 5,
    image: '/images/user5.jpg',
    name: 'Bessie Cooper',
    email: 'scs@netmail.com',
    phone: '(405) 555-0128',
    country: 'Iceland',
    department: 'Designer',
    date: '11 May 2025',
    role: 'Staff',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '202 Birch Blvd',
    gender: 'Female',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR005'
  },
  {
    id: 6,
    image: '/images/user6.jpg',
    name: 'Kristin Watson',
    email: 'scs@netmail.com',
    phone: '(308) 555-0121',
    country: 'Algeria',
    department: 'Management',
    date: '11 May 2025',
    role: 'Staff',
    status: false,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '303 Elm St',
    gender: 'Female',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR006'
  },
  {
    id: 7,
    image: '/images/user7.jpg',
    name: 'Kathryn Murphy',
    email: 'scs@netmail.com',
    phone: '(603) 555-0123',
    country: 'Bahrain',
    department: 'Designer',
    date: '11 May 2025',
    role: 'Staff',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '404 Maple Dr',
    gender: 'Female',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR007'
  },
  {
    id: 8,
    image: '/images/user8.jpg',
    name: 'Theresa Webb',
    email: 'scs@netmail.com',
    phone: '(702) 555-0122',
    country: 'Afghanistan',
    department: 'Account',
    date: '11 May 2025',
    role: 'Employee',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '505 Willow Way',
    gender: 'Female',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR008'
  },
  {
    id: 9,
    image: '/images/user9.jpg',
    name: 'Cameron Williamson',
    email: 'scs@netmail.com',
    phone: '(205) 555-0100',
    country: 'Haiti',
    department: 'Designer',
    date: '11 May 2025',
    role: 'Employee',
    status: false,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '606 Poplar St',
    gender: 'Male',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR009'
  },
  {
    id: 10,
    image: '/images/user10.jpg',
    name: 'Jerome Bell',
    email: 'scs@netmail.com',
    phone: '(406) 555-0120',
    country: 'Saint Barthélemy',
    department: 'Designer',
    date: '11 May 2025',
    role: 'Staff',
    status: true,
    showDropdown: false,
    joiningDate: '2025-05-11',
    address: '707 Sycamore Dr',
    gender: 'Male',
    dutySchedule: '9:00 AM - 5:00 PM',
    password: 'password123',
    userId: 'USR010'
  }
]);

const showEditUserModal = ref(false);
const selectedUserForEdit = ref(null);

// New reactive state for delete confirmation modal
const showDeleteConfirmationModal = ref(false);
const userToDelete = ref(null);

const getRoleBadgeClass = (role) => {
  switch(role) {
    case 'Admin': return 'bg-purple-100 text-purple-800';
    case 'Super Admin': return 'bg-blue-100 text-blue-800';
    case 'HR': return 'bg-pink-100 text-pink-800';
    case 'Staff': return 'bg-green-100 text-green-800';
    default: return 'bg-gray-100 text-gray-800';
  }
};

const toggleStatus = (user) => {
  user.status = !user.status;
};

const toggleDropdown = (user) => {
  users.value.forEach(u => {
    if (u.id !== user.id) u.showDropdown = false;
  });
  user.showDropdown = !user.showDropdown;
};

const closeDropdowns = () => {
  users.value.forEach(u => {
    u.showDropdown = false;
  });
};

document.addEventListener('click', (e) => {
  if (!e.target.closest('.dropdown-button') && !e.target.closest('.dropdown-menu')) {
    closeDropdowns();
  }
});

const openEditUserModal = (user) => {
  selectedUserForEdit.value = { ...user };
  showEditUserModal.value = true;
  closeDropdowns();
  console.log('Opening Edit User Modal for:', selectedUserForEdit.value);
};

const closeEditUserModal = () => {
  showEditUserModal.value = false;
  selectedUserForEdit.value = null;
  console.log('Closing Edit User Modal');
};

const handleUserUpdated = (updatedUserData) => {
  const index = users.value.findIndex(user => user.id === updatedUserData.id);
  if (index !== -1) {
    users.value[index] = { ...users.value[index], ...updatedUserData };
    console.log('User updated in All.vue:', users.value[index]);
  }
};

// Functions for delete confirmation and action
const openDeleteConfirmationModal = (user) => {
  userToDelete.value = user; // Set the user to be deleted
  showDeleteConfirmationModal.value = true;
  closeDropdowns(); // Close any open dropdown
  console.log('Opening Delete Confirmation Modal for:', user.name);
};

const closeDeleteConfirmationModal = () => {
  showDeleteConfirmationModal.value = false;
  userToDelete.value = null; // Clear user to delete
  console.log('Closing Delete Confirmation Modal');
};

const confirmUserDeletion = () => {
  if (userToDelete.value) {
    // Send a DELETE request to the Laravel backend
    // Make sure you have a route named 'users.destroy' in your web.php or api.php
    router.delete(route('users.destroy', userToDelete.value.id), {
      onSuccess: () => {
        // If deletion is successful on the backend, remove the user from the local array
        const index = users.value.findIndex(user => user.id === userToDelete.value.id);
        if (index !== -1) {
          users.value.splice(index, 1);
          console.log(`User ${userToDelete.value.name} (ID: ${userToDelete.value.id}) removed successfully.`);
        }
        closeDeleteConfirmationModal(); // Close the modal after successful deletion
        // Optionally, display a success toast/flash message here
      },
      onError: (errors) => {
        // Handle errors from the backend (e.g., validation, authorization)
        console.error('Error deleting user:', errors);
        alert('Failed to delete user. Please check console for details.');
        closeDeleteConfirmationModal(); // Close the modal even on error
      },
      onFinish: () => {
        // This callback runs regardless of success or failure
        console.log('Delete request finished for user:', userToDelete.value ? userToDelete.value.name : 'N/A');
      }
    });
  } else {
    console.warn('No user selected for deletion in confirmUserDeletion.');
    closeDeleteConfirmationModal();
  }
};
</script>

---

<template>
  <Head title="Customer List" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customer List</h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
              <h1 class="text-xl font-semibold text-gray-900">Customer List</h1>

              <div class="flex flex-wrap sm:flex-nowrap gap-3 items-center w-full sm:w-auto">
                <div class="flex items-center gap-2 w-full sm:w-auto">
                  <label for="show" class="text-sm text-gray-500 whitespace-nowrap">Show</label>
                  <select
                    id="show"
                    class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-primary w-full sm:w-20"
                  >
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                  </select>
                </div>

                <div class="relative w-full sm:w-52">
                  <input
                    type="text"
                    placeholder="Search"
                    class="border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-primary"
                  />
                  <svg
                    class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                  </svg>
                </div>

                <button
                  class="bg-[#0A97B0] text-white px-4 py-2 rounded-md font-medium hover:bg-[#0A97B0]/90 transition w-full sm:w-auto"
                >
                  + Add User
                </button>
              </div>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="p-4">
                      <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                    <td class="p-4">
                      <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <img :src="user.image" :alt="user.name" class="w-10 h-10 rounded-full object-cover">
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                      <div class="text-sm text-gray-500">{{ user.email }}</div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ user.phone }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ user.country }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ user.department }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ user.date }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <span :class="getRoleBadgeClass(user.role)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                        {{ user.role }}
                      </span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <button
                        @click.stop="toggleStatus(user)"
                        type="button"
                        class="relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                        :class="user.status ? 'bg-[#0A97B0]' : 'bg-gray-200'"
                      >
                        <span
                          aria-hidden="true"
                          class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                          :class="user.status ? 'translate-x-5' : 'translate-x-0'"
                        />
                      </button>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                      <div class="relative inline-block text-left">
                        <button
                          @click.stop="toggleDropdown(user)"
                          type="button"
                          class="dropdown-button flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                        >
                          <span class="sr-only">Open options</span>
                          <span class="text-xl">⋮</span>
                        </button>

                        <transition
                          enter-active-class="transition ease-out duration-100"
                          enter-from-class="transform opacity-0 scale-95"
                          enter-to-class="transform opacity-100 scale-100"
                          leave-active-class="transition ease-in duration-75"
                          leave-from-class="transform opacity-100 scale-100"
                          leave-to-class="transform opacity-0 scale-95"
                        >
                          <div
                            v-show="user.showDropdown"
                            class="dropdown-menu absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                          >
                            <div class="py-1">
                              <button
                                @click="openEditUserModal(user)"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                              >
                                Edit
                              </button>
                              <button
                                @click="openDeleteConfirmationModal(user)" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left"
                              >
                                Delete
                              </button>
                            </div>
                          </div>
                        </transition>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
              <p class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">50</span> results
              </p>

              <div class="flex items-center space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                  Previous
                </button>
                <button class="px-3 py-1 border border-[#0A97B0] bg-[#0A97B0] text-white rounded-md text-sm font-medium">
                  1
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                  2
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                  3
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <EditUser
      :show="showEditUserModal"
      :user="selectedUserForEdit"
      @close="closeEditUserModal"
      @update="handleUserUpdated"
    />

    <DeleteConfirmationModal
      :show="showDeleteConfirmationModal"
      :userId="userToDelete ? userToDelete.id : null" :userName="userToDelete ? userToDelete.name : ''"
      @confirm="confirmUserDeletion"
      @cancel="closeDeleteConfirmationModal"
    />
  </AuthenticatedLayout>
</template>

---

<style scoped>
/* Add any custom styles here if needed */
</style>