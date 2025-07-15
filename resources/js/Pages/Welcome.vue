<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="SPARKTRO Admin Kit" />
    <div
        class="bg-gray-50 text-black/70 dark:bg-black dark:text-white/70 min-h-screen flex flex-col"
    >
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px] opacity-10 pointer-events-none select-none"
            src="https://laravel.com/assets/img/welcome/background.svg"
            alt="Background decorative image"
        />

        <main
            class="flex-grow flex flex-col items-center justify-center px-6 text-center max-w-2xl mx-auto"
        >
            <!-- Logo -->
            <div class="flex mb-6">
                <Link href="/" aria-label="Home">
                    <ApplicationLogo class="h-12 w-auto text-gray-700" />
                </Link>
            </div>
            <h1 class="text-4xl font-extrabold mb-4 text-black dark:text-white">
                Welcome to SPARKTRO Admin Kit
            </h1>
            <p class="mb-8 text-lg max-w-md text-black/70 dark:text-white/70">
                Experience the power and simplicity of Laravel with this clean
                starter page.
            </p>
            <Link
                v-if="canLogin"
                :href="route('login')"
                class="inline-block rounded-md bg-[#0A97B0] px-6 py-3 text-white font-semibold hover:bg-teal-600 transition"
            >
                Log in
            </Link>
        </main>

        <footer
            class="py-8 text-center text-sm text-black/50 dark:text-white/50"
        ></footer>
    </div>
</template>
