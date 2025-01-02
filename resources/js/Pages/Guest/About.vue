<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
</script>

<template>
    <GuestLayout>
        <Head title="About Us" />

        <div class="container py-12 px-6 bg-gray-50 rounded-xl shadow-2xl mx-auto max-w-3xl">
            <div class="text-center mb-10">
                <!-- Logo Component -->
                <ApplicationLogo class="mx-auto mb-4 w-32" />

                <!-- About Us Title with updated font -->
                <h1 class="text-5xl font-extrabold text-red-400 mb-6 font-heading tracking-wide">
                    About Us
                </h1>
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    We are a membership-based ice cream retail business that aims to revolutionize the ice cream industry by offering a membership-based model via vending machines. Our primary goal is to prioritize affordability and convenience for our members, offering high-quality ice cream at a discount of 33% to 50%.
                </p>
            </div>

            <div class="mb-8">
                <!-- Vision Title with improved typography -->
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Vision
                </h2>
                <p class="text-lg text-gray-700 mb-4 leading-relaxed">
                    To make premium ice cream affordable and accessible to everyone, everywhere.
                </p>
            </div>

            <div class="mb-8">
                <!-- Mission Title with improved typography -->
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Mission
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Leverage automated vending technology to disrupt the traditional ice cream market, increasing customer loyalty through significant membership benefits.
                </p>
            </div>

            <div class="bg-red-50 rounded-lg mt-10">
            <div class="flex flex-row space-x-1">
                <a
                    class="w-full py-2 px-4 bg-yellow-300 text-gray-700 rounded-lg shadow hover:bg-yellow-500"
                    :href="route('home')"
                >
                    <div class="items-center py-4 text-center">
                        Home
                    </div>
                </a>
            </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Tailwind font-family settings */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&family=Raleway:wght@500;700&display=swap');

/* Custom font-family for headings */
.font-heading {
    font-family: 'Poppins', sans-serif;
}

/* Additional custom styles */
.container {
    max-width: 800px;
    margin: auto;
}
</style>
