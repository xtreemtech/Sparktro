<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
  import RevenueChart from "@/Components/Charts/RevenueChart.vue";
/*import SalesChart from "@/Components/Charts/SalesChart.vue";
import CalendarSchedule from "@/Components/CalendarSchedule.vue";
import BrowseStatus from "@/Components/BrowseStatus.vue";
import TaskStatus from "@/Components/TaskStatus.vue";*/

import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import TopMetrics from "@/Components/Charts/TopMetrics.vue";

const showingNavigationDropdown = ref(false);

const sidebarVisible = ref(true);
function toggleSidebar() {
  sidebarVisible.value = !sidebarVisible.value;
}

const userMenuOpen = ref(false);
const rolePermissionMenuOpen = ref(false);
const profileMenuOpen = ref(false);
const notificationMenuOpen = ref(false);
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
            <a
              href="#"
              :class="{ 'sidebar-active-link': true, 'justify-center': !sidebarVisible }"
              class="sidebar-link group"
            >
              <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">grid_view</i>
                <span v-if="sidebarVisible">Dashboard</span>
              </span>
              <svg
                v-if="sidebarVisible"
                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </li>

          <li>
            <div
              @click="userMenuOpen = !userMenuOpen"
              :class="{ 'sidebar-active-link': userMenuOpen, 'justify-center': !sidebarVisible }"
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
            </div>

            <transition
              enter-active-class="transition duration-300 ease-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-40"
              leave-active-class="transition duration-300 ease-in"
              leave-from-class="opacity-100 max-h-40"
              leave-to-class="opacity-0 max-h-0"
            >
              <ul v-show="userMenuOpen" class="ml-5 mt-0 space-y-1 overflow-hidden">
                <li class="py-2">
                  <a href="#" class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro">- User List</a>
                </li>
                <li class="py-1">
                  <a href="#" class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro">- Create New User</a>
                </li>
              </ul>
            </transition>
          </li>

          <li>
            <div
              @click="rolePermissionMenuOpen = !rolePermissionMenuOpen"
              :class="{ 'sidebar-active-link': rolePermissionMenuOpen, 'justify-center': !sidebarVisible }"
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
            </div>

            <transition
              enter-active-class="transition duration-300 ease-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-40"
              leave-active-class="transition duration-300 ease-in"
              leave-from-class="opacity-100 max-h-40"
              leave-to-class="opacity-0 max-h-0"
            >
              <ul v-show="rolePermissionMenuOpen" class="ml-5 mt-0 space-y-1 overflow-hidden">
                <li class="py-2">
                  <a href="#" class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro">- Role</a>
                </li>
                <li class="py-1">
                  <a href="#" class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro">- Assign Role & Permissions</a>
                </li>
              </ul>
            </transition>
          </li>

          <li>
            <a
              href="#"
              :class="{'justify-center': !sidebarVisible}"
              class="sidebar-link group"
            >
              <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">history</i>
                <span v-if="sidebarVisible">Activity Logs</span>
              </span>
              <svg
                v-if="sidebarVisible"
                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
              <span v-if="!sidebarVisible" class="sidebar-tooltip">Activity Logs</span>
            </a>
          </li>
          <li>
            <div
              @click="profileMenuOpen = !profileMenuOpen"
              :class="{ 'justify-center': !sidebarVisible }"
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
            <transition>
              <ul v-show="profileMenuOpen" class="ml-5 mt-0 space-y-1 overflow-hidden">
                <li class="py-2">
                  <a href="#" class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro">- My Profile</a>
                </li>
              </ul>
            </transition>
          </li>
          <li>
            <div
              @click="notificationMenuOpen = !notificationMenuOpen"
              :class="{ 'justify-center': !sidebarVisible }"
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
             <transition>
              <ul v-show="notificationMenuOpen" class="ml-5 mt-0 space-y-1 overflow-hidden">
                <li class="py-2">
                  <a href="#" class="block text-sm font-medium text-gray-700 hover:text-primary-sparktro">- All Notifications</a>
                </li>
              </ul>
            </transition>
          </li>
          <li>
            <a
              href="#"
              :class="{'justify-center': !sidebarVisible}"
              class="sidebar-link group"
            >
              <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">settings</i>
                <span v-if="sidebarVisible">Settings</span>
              </span>
              <svg
                v-if="sidebarVisible"
                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
              <span v-if="!sidebarVisible" class="sidebar-tooltip">Settings</span>
            </a>
          </li>
          <li class="mt-auto pt-4">
            <a
              href="#"
              :class="{'justify-center': !sidebarVisible}"
              class="sidebar-link group"
            >
              <span class="flex items-center" :class="{'w-full justify-center': !sidebarVisible}">
                <i class="material-icons text-xl mr-2" :class="{'!mr-0': !sidebarVisible}">logout</i>
                <span v-if="sidebarVisible">Logout</span>
              </span>
              <svg
                v-if="sidebarVisible"
                class="w-4 h-4 transform transition-transform duration-300 sidebar-arrow"
                fill="none" stroke="currentColor" viewBox="0 0 24 24"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
              <span v-if="!sidebarVisible" class="sidebar-tooltip">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <div class="flex-1 flex flex-col">
      <header
        class="bg-white shadow-sm h-[68px] px-6 py-2.5 flex justify-between items-center border-b border-gray-sparktro"
      >
        <div class="flex items-center relative w-[300px] gap-[10px]">
          <svg
            class="absolute left-4 w-4 h-4 text-black-sparktro/50 pointer-events-none"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z"
            />
          </svg>
          <input
            type="text"
            placeholder="Search..."
            class="w-full h-[40px] py-[12px] pr-[16px] pl-[40px] border border-gray-sparktro rounded-[8px] focus:outline-none focus:ring-1 focus:ring-primary-sparktro focus:border-primary-sparktro"
          />
        </div>

        <div class="flex items-center space-x-4 ml-4">
          <div class="relative">
            <select
              class="appearance-none border-0 rounded px-3 py-1 text-sm focus:outline-none pr-7 bg-white [&::-ms-expand]:hidden"
            >
              <option value="en">English</option>
              <option value="bd">Bangla</option>
            </select>
          </div>

          <button class="relative text-black-sparktro">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a2 2 0 002-2H8a2 2 0 002 2z"
              />
            </svg>
            <span
              class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-sparktro rounded-full"
            ></span>
          </button>

          <div class="relative group">
            <div
              class="w-8 h-8 rounded-full bg-primary-sparktro flex items-center justify-center text-white font-bold cursor-pointer"
            >
              JD
            </div>
            <div
              class="absolute right-0 mt-2 w-40 bg-white border border-gray-sparktro rounded shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-50"
            >
              <div class="p-2 text-sm">
                <p class="font-semibold text-black-sparktro">John Doe</p>
                <p class="text-black-sparktro/60">john@example.com</p>
              </div>
              <div class="border-t border-gray-sparktro">
                <a
                  href="#"
                  class="block px-3 py-2 text-sm hover:bg-gray-sparktro"
                  >Profile</a
                >
                <a
                  href="#"
                  class="block px-3 py-2 text-sm hover:bg-gray-sparktro"
                  >Logout</a
                >
              </div>
            </div>
          </div>
        </div>
      </header>

      <main class="p-6 bg-gray-sparktro">
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
      </main>
    </div>
  </div>
</template>

<style scoped>
/* Custom Sparktro Colors (add these to your Tailwind config or here for demo) */
.text-black-sparktro { color: #333333; }
.text-primary-sparktro { color: #667EEA; } /* Example primary color */
.bg-primary-sparktro\/10 { background-color: rgba(102, 126, 234, 0.1); }
.border-gray-sparktro { border-color: #E5E7EB; } /* A light gray for borders */
.bg-gray-sparktro { background-color: #F8F9FA; } /* The light background color */
.bg-red-sparktro { background-color: #EF4444; }

/* Base link styles */
.sidebar-link {
  @apply py-2 px-3 flex items-center text-sm font-bold text-gray-700 hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200;
}

/* Active link styles (adjust colors to match Figma exactly) */
.sidebar-active-link {
  @apply bg-primary-sparktro/10 text-primary-sparktro; /* Example: light primary background, primary text */
  /* If you want the more solid fill as in Figma, adjust bg and text colors */
  /* @apply bg-primary-sparktro text-white; */
}

.sidebar-active-link .sidebar-arrow {
  @apply text-primary-sparktro; /* Arrow color for active link */
  /* If solid fill, @apply text-white; */
}

/* Specific styling for icons */
.sidebar-link .material-icons {
  @apply text-lg; /* Default icon size */
  transition: all 0.2s ease-in-out; /* Smooth transition for icon changes */
}

/* Adjust icon color based on link state */
.sidebar-link:hover .material-icons,
.sidebar-active-link .material-icons {
  @apply text-primary-sparktro; /* Icon color on hover/active */
  /* If solid fill active, @apply text-white; */
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