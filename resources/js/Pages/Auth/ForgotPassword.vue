<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import ForgotPassBanner from "@/Components/ForgotPassBanner.vue";
import { ref } from "vue";

defineProps({
    canResetPassword: Boolean,
});

const form = useForm({
    email: "",
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
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
        <Head title="Forgot password" />

        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Banner -->
            <div
                class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-8"
            >
                <ForgotPassBanner class="text-gray-500" />
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
                            Forgot Password
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Enter your email for the verification process,we will send 4 digits code to your email.
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
                                Send Link
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
