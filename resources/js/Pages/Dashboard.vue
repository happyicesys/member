<script setup>
import { ClockIcon, TicketIcon, SparklesIcon, UserCircleIcon } from '@heroicons/vue/20/solid';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />

        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-red-400 font-heading tracking-wide">
                    Welcome Back!
                </h2>
            </div>
        </template>

        <div class="py-10 bg-gray-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="p-6 bg-white rounded-xl shadow-lg">
                    <div class="text-center">
                        <div class="flex items-center justify-center mx-auto mb-4">
                            <span>
                                <img src="/images/dcvend_mascot_01.png" alt="Mascot" class="w-28 h-28 sm:w-20 sm:h-20 opacity-90" />
                            </span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-yellow-500 font-heading mb-4">
                            You're Logged In!
                        </h3>
                        <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                            Explore your dashboard to manage your profile, view exclusive deals, and unlock special features just for you!
                        </p>

                        <div class="grid gap-6 sm:grid-cols-2 grid-cols-1">
                            <!-- Your Benefits Section -->
                            <div class="p-6 bg-yellow-50 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold text-gray-800 mb-2">
                                    Your Benefits
                                </h4>
                                <ul class="list-disc list-inside text-gray-600">
                                    <li>Access personalized recommendations.</li>
                                    <li>Track your progress and rewards.</li>
                                    <li>Stay updated with the latest offers.</li>
                                </ul>
                            </div>

                            <!-- Quick Links Section -->
                            <div class="p-6 bg-red-50 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold text-gray-800 mb-2">
                                    Quick Links
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    <button class="flex-1 py-2 px-4 bg-red-400 text-white rounded-lg shadow hover:bg-red-500">
                                        <div class="flex flex-col items-center">
                                            <TicketIcon class="w-9 h-9" />
                                            <span>Vouchers</span>
                                        </div>
                                    </button>
                                    <button class="flex-1 py-2 px-4 bg-red-400 text-white rounded-lg shadow hover:bg-red-500">
                                        <div class="flex flex-col items-center">
                                            <ClockIcon class="w-9 h-9" />
                                            <span>History</span>
                                        </div>
                                    </button>
                                    <a
                                        class="flex-1 py-2 px-4 bg-red-400 text-white rounded-lg shadow hover:bg-red-500"
                                        :href="route('plan.index')"
                                    >
                                        <div class="flex flex-col items-center">
                                            <SparklesIcon class="w-9 h-9" />
                                            <span>Plans</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 text-center">
                        <p class="text-gray-600">
                            Need help? <a href="#" class="text-red-400 underline hover:text-red-500">Contact Support</a>
                        </p>
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
</style>
