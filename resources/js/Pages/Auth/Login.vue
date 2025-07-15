<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import LoginPageBanner from "@/Components/LoginPageBanner.vue";
import { ref } from "vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const fillDemoCredentials = () => {
    form.email = "sparktroadmin@yopmail.com";
    form.password = "Test@1234";
};
</script>

<style scoped>
.fill-demo-btn {
    background-color: var(--sparktro-primary);
}
.fill-demo-btn:hover {
    background-color: var(--sparktro-black);
}
</style>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Banner -->
            <div
                class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-8"
            >
                <LoginPageBanner class="text-gray-500" />
            </div>

            <!-- Right Form -->
            <div
                class="flex flex-col justify-center w-full md:w-1/2 px-8 py-12 sm:px-12 my-5"
            >
                <div class="bg-white rounded-lg shadow-lg pt-20 pb-20 px-16">
                    <!-- Logo -->
                    <div class="flex mb-6">
                        <Link href="/" aria-label="Home">
                            <ApplicationLogo
                                class="h-12 w-auto text-gray-700"
                            />
                        </Link>
                    </div>

                    <!-- Heading -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">
                            Welcome Back
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Please sign in to your account
                        </p>
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-6" novalidate>
                        <!-- Email -->
                        <div>
                            <InputLabel for="email" value="User Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                aria-required="true"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                class="mt-1 block w-full pr-12"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                aria-required="true"
                            />

                            <!-- Eye icon -->
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                tabindex="-1"
                                aria-label="Toggle password visibility"
                            >
                                <svg
                                    v-if="showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.958 9.958 0 012.766-4.316m1.914-1.4A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.982 9.982 0 01-4.254 5.616M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18"
                                    />
                                </svg>
                            </button>

                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <!-- Remember me -->
                        <div class="flex items-center justify-between">
                            <label
                                class="flex items-center text-sm text-gray-600 cursor-pointer"
                            >
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ml-2 select-none"
                                    >Remember me on this device</span
                                >
                            </label>
                        </div>

                        <!-- Submit -->
                        <div>
                            <PrimaryButton
                                class="w-full flex justify-center items-center text-center bg-teal-800 text-white font-semibold rounded-lg px-4 py-2 transition duration-300 hover:from-[#0A97B0] hover:to-[#064a55] hover:bg-gradient-to-l"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        form.processing,
                                }"
                                :disabled="form.processing"
                                aria-busy="form.processing"
                            >
                                Log in
                            </PrimaryButton>

                            <!-- Forgot Password -->
                            <div class="mt-4 text-center">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-[#FF4340] font-medium text-[14px] hover:underline"
                                >
                                    Forgot password?
                                </Link>
                            </div>

                            <!-- Demo Credentials -->
                            <div
                                class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm mt-6"
                            >
                                <div
                                    class="flex justify-between items-center space-x-4 flex-wrap"
                                >
                                    <div
                                        class="flex flex-col text-gray-700 min-w-[180px]"
                                    >
                                        <p class="mb-1">
                                            Email: sparktroadmin@yopmail.com
                                        </p>
                                        <p>Password: Test@1234</p>
                                    </div>
                                    <div>
                                        <button
                                            type="button"
                                            @click="fillDemoCredentials"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg fill-demo-btn"
                                        >
                                            Fill in demo credentials
                                            <svg
                                                class="rtl:rotate-180 w-4 h-4 ms-2"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 14 10"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M1 5h12m0 0L9 1m4 4L9 9"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Message -->
                        <div
                            v-if="status"
                            class="text-sm font-medium text-danger mt-4 text-center"
                            role="alert"
                            aria-live="polite"
                        >
                            {{ status }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
