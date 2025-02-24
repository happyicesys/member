<script setup>
import { ref } from 'vue';
import { ClockIcon, TicketIcon, SparklesIcon } from '@heroicons/vue/20/solid';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const isVouchersDisabled = ref(true); // Set the disabled state for the "Vouchers" button
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />

        <div class="py-4 bg-white">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Closable Banner -->

                <div class="p-8 bg-gray-50 rounded-lg shadow-md text-center">
                    <section class="text-white rounded my-2 md:w-4/6 mx-auto py-5">
                        <img src="/images/icon.png" alt="Vion Icon" class="w-1/3 lg:w-1/6 rounded mx-auto" />
                    </section>
                    <h1 class="text-3xl font-bold text-yellow-500 mb-5">Hi {{ $page.props.auth.user.name }}!</h1>
                    <h2 class="text-3xl font-extrabold text-red-600 mb-6">You're Logged In!</h2>
                    <p class="text-gray-600 mb-10">
                        Explore your dashboard to manage your profile, view exclusive deals, and unlock special features just for you!
                    </p>
                    <div class="grid grid-cols-2 gap-5 md:w-2/3 mx-auto">
                        <button class="py-6 px-4 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition text-center">
                            <Link :href="route('benefit')" class="flex flex-col space-y-1 items-center">
                                <img src="/images/components/button_benefits.png" alt="Benefits Button" class="w-1/3 lg:w-1/6 rounded mx-auto" />
                                <span class="lg:text-lg text-gray-700 font-semibold">Benefits</span>
                            </Link>
                        </button>
                        <button
                            :class="[
                                'py-6 px-4 bg-gray-100 rounded-lg shadow-md text-center transition flex flex-col space-y-1 items-center',
                                isVouchersDisabled ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-lg'
                            ]"
                            :disabled="isVouchersDisabled"
                        >
                            <img src="/images/components/button_vouchers.png" alt="Vouchers Button" class="w-1/3 lg:w-1/6 rounded mx-auto" />
                            <span class="lg:text-lg text-gray-700 font-semibold">Vouchers</span>
                        </button>
                        <button class="py-6 px-4 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition text-center">
                            <Link :href="route('history')" class="flex flex-col space-y-1 items-center">
                                <img src="/images/components/button_history.png" alt="Plans History" class="w-1/3 lg:w-1/6 rounded mx-auto" />
                                <span class="lg:text-lg text-gray-700 font-semibold">Purchase History</span>
                            </Link>
                        </button>
                        <button class="py-6 px-4 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition text-center">
                            <Link :href="route('plan.index')" class="flex flex-col space-y-1 items-center">
                                <img src="/images/components/button_plans.png" alt="Plans Button" class="w-1/3 lg:w-1/6 rounded mx-auto" />
                                <span class="lg:text-lg text-gray-700 font-semibold">Membership Plan</span>
                            </Link>
                        </button>
                    </div>
                    <div class="py-8 text-gray-600">
                        Need help?
                        <Link :href="route('contact-us')" class="text-red-500 underline hover:text-red-600">
                            Contact Us
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap');

.font-heading {
    font-family: 'Poppins', sans-serif;
}

button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
