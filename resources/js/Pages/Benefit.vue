<script setup>
import { ref } from 'vue';
import { ClockIcon, TicketIcon, SparklesIcon } from '@heroicons/vue/20/solid';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const showBanner = ref(true);

const dismissBanner = () => {
    showBanner.value = false;
};

const isVouchersDisabled = ref(true); // Set the disabled state for the "Vouchers" button
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Benefit" />

        <div class="py-4 bg-white">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">

                <div class="p-8 bg-gray-50 rounded-lg shadow-md text-center">
                    <section class="text-white rounded my-2 md:w-4/6 mx-auto py-5">
                        <img src="/images/icon.png" alt="Vion Icon" class="w-1/3 lg:w-1/6 rounded mx-auto" />
                    </section>
                    <h1 class="text-3xl font-bold text-yellow-500 mb-5">Hi {{ $page.props.auth.user.name }}!</h1>
                    <h2 class="text-3xl font-extrabold text-red-600 mb-6">Your Benefits</h2>
                    <ul class="list-disc text-gray-600 flex flex-col justify-center lg:w-1/4 mx-auto">
                        <li>
                          Access personalized recommendations
                        </li>
                        <li>
                          Track your progress and rewards
                        </li>
                        <li>
                          Stay updated with the latest offers
                        </li>
                    </ul>
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
</style>
