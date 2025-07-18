<script setup>
import { ref, watch, computed } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue'; // You're importing this, but not using it for the user dropdown. Consider using it!
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';

// Access the current Inertia page object
const page = usePage();

// --- Sidebar Specific States and Functions ---
const sidebarVisible = ref(true); // Manages sidebar open/close state
function toggleSidebar() {
    sidebarVisible.value = !sidebarVisible.value;
}

// Reactive states for sidebar menu dropdowns
const userMenuOpen = ref(false);
const rolePermissionMenuOpen = ref(false);
const profileMenuOpen = ref(false);
const notificationMenuOpen = ref(false);
const settingsMenuOpen = ref(false);

// --- NEW STATE FOR USER DROPDOWN ---
const userDropdownOpen = ref(false);

// Function to close the user dropdown when clicking outside
const closeUserDropdown = (event) => {
    // Check if the click occurred inside the dropdown or the avatar itself
    // We need to ensure the event target is not within the dropdown or the button that opens it.
    const userDropdownContainer = document.getElementById('user-dropdown-container'); // Add an ID to the main user dropdown div
    const userAvatarButton = document.getElementById('user-avatar-button'); // Add an ID to the avatar button

    if (userDropdownOpen.value && userDropdownContainer && userAvatarButton) {
        if (!userDropdownContainer.contains(event.target) && !userAvatarButton.contains(event.target)) {
            userDropdownOpen.value = false;
        }
    }
};

// Add/remove click listener globally to close dropdown when clicking outside
watch(userDropdownOpen, (isOpen) => {
    if (isOpen) {
        document.addEventListener('click', closeUserDropdown);
    } else {
        document.removeEventListener('click', closeUserDropdown);
    }
});

// Watch for sidebar visibility changes to close sub-menus when collapsed
watch(sidebarVisible, (newVal) => {
    if (!newVal) {
        userMenuOpen.value = false;
        rolePermissionMenuOpen.value = false;
        profileMenuOpen.value = false;
        notificationMenuOpen.value = false;
        settingsMenuOpen.value = false;
    }
});

// --- Computed properties for active parent menu items ---
const isDashboardActive = computed(() => route().current('dashboard'));
const isUserManagementActive = computed(() =>
    route().current('users.all') || route().current('users.create')
);
const isRolePermissionActive = computed(() =>
    route().current('role-permission.roles') ||
    route().current('role-permission.assign')
);
const isActivityLogsActive = computed(() =>
    route().current('activity-logs.index')
);
const isProfileManagementActive = computed(() =>
    route().current('profile.edit')
);
const isNotificationsActive = computed(() =>
    route().current('notifications.index')
);
const isSettingsActive = computed(() =>
    route().current('settings.index')
);

// --- Watch for route changes to automatically open parent menus ---
watch(() => page.url, (newUrl) => {
    userMenuOpen.value = newUrl.startsWith('/users');
    rolePermissionMenuOpen.value = newUrl.startsWith('/role-permission');
    profileMenuOpen.value = newUrl.startsWith('/profile');
    notificationMenuOpen.value = newUrl.startsWith('/notifications');
    settingsMenuOpen.value = newUrl.startsWith('/settings');
}, { immediate: true });
</script>

<template>
    <div class="bg-gray-sparktro min-h-screen flex relative">
        <aside
            :class="sidebarVisible ? 'w-[280px]' : 'w-[72px]'"
            class="bg-white border-r border-gray-sparktro transition-all duration-300 relative overflow-hidden flex flex-col"
        >
            <div
                class="logo-area flex items-center justify-between h-[68px] px-4 py-2.5 border-b border-gray-sparktro"
            >
                <div v-if="sidebarVisible" class="flex shrink-0 items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo
                            class="block h-8 w-auto fill-current text-primary-600"
                        />
                    </Link>
                </div>

                <button
                    @click="toggleSidebar"
                    :class="{'justify-center w-full': !sidebarVisible, 'ml-auto': sidebarVisible}"
                    class="sidebar-toggle-btn p-1 rounded-full text-gray-500 hover:bg-gray-100 flex items-center"
                >
                    <svg
                        :class="{'rotate-180': sidebarVisible}"
                        class="h-5 w-5 transition-transform duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto mt-6 px-4 pb-4 custom-scrollbar">
                <ul class="space-y-1">
                    <li>
                        <Link
                            :href="route('dashboard')"
                            :class="{ 'sidebar-active-link': isDashboardActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">grid_view</i>
                                <span v-if="sidebarVisible">Dashboard</span>
                            </span>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Dashboard</span>
                        </Link>
                    </li>

                    <li>
                        <div
                            @click="userMenuOpen = !userMenuOpen"
                            :class="{ 'sidebar-active-link': isUserManagementActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group cursor-pointer"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">group</i>
                                <span v-if="sidebarVisible">User Management</span>
                            </span>
                            <svg
                                v-if="sidebarVisible"
                                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                                :class="{ 'rotate-90': userMenuOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">User Management</span>
                        </div>

                        <transition
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-[500px]"
                            leave-active-class="transition duration-300 ease-in"
                            leave-from-class="opacity-100 max-h-[500px]"
                            leave-to-class="opacity-0 max-h-0"
                        >
                            <ul v-show="userMenuOpen && sidebarVisible" class="ml-5 mt-0 space-y-1 overflow-hidden">
                                <li class="py-2">
                                    <Link
                                        :href="route('users.all')"
                                        :class="{ 'sidebar-active-link': route().current('users.all') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - User List
                                    </Link>
                                </li>
                                <li class="py-1">
                                    <Link
                                        :href="route('users.create')"
                                        :class="{ 'sidebar-active-link': route().current('users.create') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - Create New User
                                    </Link>
                                </li>
                            </ul>
                        </transition>
                    </li>

                    <li>
                        <div
                            @click="rolePermissionMenuOpen = !rolePermissionMenuOpen"
                            :class="{ 'sidebar-active-link': isRolePermissionActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group cursor-pointer"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">manage_accounts</i>
                                <span v-if="sidebarVisible">Role & Permission</span>
                            </span>
                            <svg
                                v-if="sidebarVisible"
                                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                                :class="{ 'rotate-90': rolePermissionMenuOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Role & Permission</span>
                        </div>

                        <transition
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-[500px]"
                            leave-active-class="transition duration-300 ease-in"
                            leave-from-class="opacity-100 max-h-[500px]"
                            leave-to-class="opacity-0 max-h-0"
                        >
                            <ul v-show="rolePermissionMenuOpen && sidebarVisible" class="ml-5 mt-0 space-y-1 overflow-hidden">
                                <li class="py-2">
                                    <Link
                                        :href="route('role-permission.roles')"
                                        :class="{ 'sidebar-active-link': route().current('role-permission.roles') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - Role
                                    </Link>
                                </li>
                                <li class="py-1">
                                    <Link
                                        :href="route('role-permission.assign')"
                                        :class="{ 'sidebar-active-link': route().current('role-permission.assign') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - Assign Role & Permissions
                                    </Link>
                                </li>
                            </ul>
                        </transition>
                    </li>

                    <li>
                        <Link
                            :href="route('activity-logs.index')"
                            :class="{ 'sidebar-active-link': isActivityLogsActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">history</i>
                                <span v-if="sidebarVisible">Activity Logs</span>
                            </span>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Activity Logs</span>
                        </Link>
                    </li>

                    <li>
                        <div
                            @click="profileMenuOpen = !profileMenuOpen"
                            :class="{ 'sidebar-active-link': isProfileManagementActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group cursor-pointer"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">person</i>
                                <span v-if="sidebarVisible">Profile Management</span>
                            </span>
                            <svg
                                v-if="sidebarVisible"
                                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                                :class="{ 'rotate-90': profileMenuOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Profile Management</span>
                        </div>
                        <transition
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-40"
                            leave-active-class="transition duration-300 ease-in"
                            leave-from-class="opacity-100 max-h-40"
                            leave-to-class="opacity-0 max-h-0"
                        >
                            <ul v-show="profileMenuOpen && sidebarVisible" class="ml-5 mt-0 space-y-1 overflow-hidden">
                                <li class="py-2">
                                    <Link
                                        :href="route('profile.edit')"
                                        :class="{ 'sidebar-active-link': route().current('profile.edit') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - My Profile
                                    </Link>
                                </li>
                            </ul>
                        </transition>
                    </li>

                    <li>
                        <div
                            @click="notificationMenuOpen = !notificationMenuOpen"
                            :class="{ 'sidebar-active-link': isNotificationsActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group cursor-pointer"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">notifications</i>
                                <span v-if="sidebarVisible">Notifications</span>
                            </span>
                            <svg
                                v-if="sidebarVisible"
                                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                                :class="{ 'rotate-90': notificationMenuOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Notifications</span>
                        </div>
                        <transition
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-40"
                            leave-active-class="transition duration-300 ease-in"
                            leave-from-class="opacity-100 max-h-40"
                            leave-to-class="opacity-0 max-h-0"
                        >
                            <ul v-show="notificationMenuOpen && sidebarVisible" class="ml-5 mt-0 space-y-1 overflow-hidden">
                                <li class="py-2">
                                    <Link
                                        :href="route('notifications.index')"
                                        :class="{ 'sidebar-active-link': route().current('notifications.index') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - All Notifications
                                    </Link>
                                </li>
                            </ul>
                        </transition>
                    </li>

                    <li>
                        <div
                            @click="settingsMenuOpen = !settingsMenuOpen"
                            :class="{ 'sidebar-active-link': isSettingsActive, 'justify-center': !sidebarVisible }"
                            class="sidebar-link group cursor-pointer"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">settings</i>
                                <span v-if="sidebarVisible">Settings</span>
                            </span>
                            <svg
                                v-if="sidebarVisible"
                                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                                :class="{ 'rotate-90': settingsMenuOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Settings</span>
                        </div>
                        <transition
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0 max-h-0"
                            enter-to-class="opacity-100 max-h-40"
                            leave-active-class="transition duration-300 ease-in"
                            leave-from-class="opacity-100 max-h-40"
                            leave-to-class="opacity-0 max-h-0"
                        >
                            <ul v-show="settingsMenuOpen && sidebarVisible" class="ml-5 mt-0 space-y-1 overflow-hidden">
                                <li class="py-2">
                                    <Link
                                        :href="route('settings.index')"
                                        :class="{ 'sidebar-active-link': route().current('settings.index') }"
                                        class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro"
                                    >
                                        - General Settings
                                    </Link>
                                </li>
                            </ul>
                        </transition>
                    </li>

                    <li class="mt-auto pt-4">
                        <Link
                            :href="route('logout')" method="post" as="button"
                            :class="{'justify-center': !sidebarVisible}"
                            class="sidebar-link group w-full text-left"
                        >
                            <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">logout</i>
                                <span v-if="sidebarVisible">Logout</span>
                            </span>
                            <span v-if="!sidebarVisible" class="sidebar-tooltip">Logout</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-sm h-[68px] px-6 py-2.5 flex justify-between items-center border-b border-gray-sparktro">
                <div class="flex items-center relative w-[300px] gap-[10px]">
                    <svg class="absolute left-4 w-4 h-4 text-black-sparktro/50 pointer-events-none" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z" />
                    </svg>
                    <input type="text" placeholder="Search..."
                        class="w-full h-[40px] py-[12px] pr-[16px] pl-[40px] border border-gray-sparktro rounded-[8px] focus:outline-none focus:ring-1 focus:ring-primary-sparktro focus:border-primary-sparktro">
                </div>

                <div class="flex items-center space-x-4 ml-4">
                    <div class="relative">
                        <select
                            class="appearance-none border-0 rounded px-3 py-1 text-sm focus:outline-none pr-7 bg-white [&::-ms-expand]:hidden">
                            <option value="en">English</option>
                            <option value="bd">Bangla</option>
                        </select>
                    </div>

                    <button class="relative text-black-sparktro">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a2 2 0 002-2H8a2 2 0 002 2z" />
                        </svg>
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-sparktro rounded-full"></span>
                    </button>

                    <div class="relative" id="user-dropdown-container">
                        <div
                            id="user-avatar-button"
                            class="w-8 h-8 rounded-full bg-primary-sparktro flex items-center justify-center text-white font-bold cursor-pointer"
                            @click="userDropdownOpen = !userDropdownOpen"
                        >
                            JD
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-200"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <div
                                v-if="userDropdownOpen"
                                class="absolute right-0 mt-2 w-40 bg-white border border-gray-sparktro rounded shadow-md z-50"
                            >
                                <div class="p-2 text-sm">
                                    <p class="font-semibold text-black-sparktro">John Doe</p>
                                    <p class="text-black-sparktro/60">john@example.com</p>
                                </div>
                                <div class="border-t border-gray-sparktro">
                                    <a href="#" class="block px-3 py-2 text-sm hover:bg-gray-sparktro">Profile</a>
                                    <a href="#" class="block px-3 py-2 text-sm hover:bg-gray-sparktro">Logout</a>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </header>

            <main class="p-6 bg-gray-sparktro">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
/* Your existing styles... */
.text-black-sparktro { color: #333333; }
.text-primary-sparktro { color: #667EEA; } /* Example primary color */
.bg-primary-sparktro\/10 { background-color: rgba(102, 126, 234, 0.1); }
.border-gray-sparktro { border-color: #E5E7EB; } /* A light gray for borders */
.bg-gray-sparktro { background-color: #F8F9FA; } /* The light background color */
.bg-red-sparktro { background-color: #EF4444; }
.text-primary-600 { color: #667EEA; } /* Added for ApplicationLogo as per sidebar */

/* Base link styles for sidebar items */
.sidebar-link {
    @apply py-2 px-3 flex items-center text-sm font-bold text-gray-700 hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200;
}

/* Active link styles (adjust colors to match Figma exactly) */
.sidebar-active-link {
    /* This uses a light primary background and primary text color as seen in the image for "Dashboard" */
    @apply bg-primary-sparktro/10 text-primary-sparktro;
}

.sidebar-active-link .sidebar-arrow {
    @apply text-primary-sparktro; /* Arrow color for active link */
}

/* Specific styling for Material Icons within sidebar links */
.sidebar-link .material-icons {
    @apply text-xl; /* Default icon size, changed from 'lg' to 'xl' for consistency with your Sidebar.vue */
    transition: all 0.2s ease-in-out; /* Smooth transition for icon changes */
    line-height: 1; /* Helps with vertical alignment of icons */
}

/* Adjust icon color based on link state */
.sidebar-link:hover .material-icons,
.sidebar-active-link .material-icons {
    @apply text-primary-sparktro; /* Icon color on hover/active */
}

/* Collapsed Sidebar Tooltip */
.sidebar-tooltip {
    @apply absolute left-full ml-4 px-3 py-1 bg-gray-800 text-white text-xs rounded-md shadow-lg
           opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200
           whitespace-nowrap z-50;
}

/* Custom Scrollbar for better appearance (optional, requires more setup for cross-browser) */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Optional: Hide scrollbar in Firefox for cleaner look */
.custom-scrollbar {
    scrollbar-width: thin; /* "auto" or "thin" */
    scrollbar-color: #888 #f1f1f1; /* thumb and track color */
}
</style>