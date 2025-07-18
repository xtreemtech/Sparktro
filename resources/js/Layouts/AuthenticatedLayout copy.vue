<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

// IMPORTANT: Import the actual Sidebar component here
import Sidebar from "@/Components/Sidebar.vue"; // Ensure this path is correct

// These are for the top navigation dropdowns, keep them if you use them
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";


const showingNavigationDropdown = ref(false);

const sidebarVisible = ref(true); // State for sidebar visibility
function toggleSidebar() {
    sidebarVisible.value = !sidebarVisible.value;
}

// No need for userMenuOpen, rolePermissionMenuOpen, etc. here anymore.
// They belong inside Sidebar.vue
</script>

<template>
    <div class="bg-gray-sparktro min-h-screen flex">
        <!-- RENDER THE IMPORTED SIDEBAR COMPONENT HERE -->
        <!-- Pass the sidebarVisible state and listen for the toggle event -->
        <Sidebar :sidebarVisible="sidebarVisible" @toggle-sidebar="toggleSidebar" />

        <!-- Main Content Area -->
        <!-- Adjust the left margin based on sidebarVisible state -->
        <div
            :class="{ 'ml-[280px]': sidebarVisible, 'ml-[72px]': !sidebarVisible }"
            class="flex-1 flex flex-col transition-all duration-300"
        >
            <!-- Top bar (Header) -->
            <header
                class="bg-white shadow-sm h-[68px] px-6 py-2.5 flex justify-between items-center border-b border-gray-sparktro"
            >
                <!-- Search Input -->
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

                <!-- Right Actions -->
                <div class="flex items-center space-x-4 ml-4">
                    <!-- Language Selector -->
                    <div class="relative">
                        <select
                            class="appearance-none border-0 rounded px-3 py-1 text-sm focus:outline-none pr-7 bg-white [&::-ms-expand]:hidden"
                        >
                            <option value="en">English</option>
                            <option value="bd">Bangla</option>
                        </select>
                    </div>

                    <!-- Notification Icon -->
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

                    <!-- User Avatar -->
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
                                <Link
                                    :href="route('profile.edit')"
                                    class="block px-3 py-2 text-sm hover:bg-gray-sparktro"
                                    >Profile</Link
                                >
                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="block w-full text-left px-3 py-2 text-sm hover:bg-gray-sparktro"
                                    >Logout</Link
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT SLOT -->
            <!-- This is where the content of Dashboard.vue (and other pages) will be rendered -->
            <main class="p-6 flex-1 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
/* Custom Sparktro Colors (add these to your Tailwind config or here for demo) */
.text-black-sparktro {
    color: #333333;
}
.text-primary-sparktro {
    color: #667eea;
} /* Example primary color */
.bg-primary-sparktro\/10 {
    background-color: rgba(102, 126, 234, 0.1);
}
.border-gray-sparktro {
    border-color: #e5e7eb;
} /* A light gray for borders */
.bg-gray-sparktro {
    background-color: #f8f9fa;
} /* The light background color */
.bg-red-sparktro {
    background-color: #ef4444;
}

/* Styles for Material Icons (ensure this is loaded globally or in app.css) */
.material-icons-outlined {
    font-family: "Material Icons Outlined";
    font-weight: normal;
    font-style: normal;
    font-size: 24px; /* Preferred icon size */
    display: inline-block;
    line-height: 1;
    text-transform: none;
    letter-spacing: normal;
    word-wrap: normal;
    white-space: nowrap;
    direction: ltr;
    /* Support for all WebKit browsers. */
    -webkit-font-smoothing: antialiased;
    /* Support for Safari and Chrome. */
    text-rendering: optimizeLegibility;
    /* Support for Firefox. */
    -moz-osx-font-smoothing: grayscale;
    /* Support for IE. */
    font-feature-settings: "liga";
}

/* Any sidebar-specific styles should now live in Sidebar.vue's <style> block */
/* These were removed from here as they are now in Sidebar.vue */
</style>
