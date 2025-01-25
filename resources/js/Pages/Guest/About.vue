<template>
    <GuestLayout>
        <Head title="About" />

        <!-- Hero Section -->
        <section class="text-white rounded my-2 px-2">
            <img src="/images/banner_about_3.jpg" alt="DCVend About Banner" class="w-full rounded hidden md:block" />
            <img src="/images/banner_about_mobile_3.jpg" alt="DCVend About Banner Mobile" class="w-full rounded md:hidden">
        </section>


        <!-- Why Join Section -->
        <section class="pb-3 pt-4 md:pt-8 bg-white px-6">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">About DCVend</h2>
                <span class="text-gray-700 text-lg">
                    We are a membership-based ice cream retail business that aims to revolutionize the ice cream industry by offering a membership-based model via vending machines. Our primary goal is to prioritize affordability and convenience for our members, offering high-quality ice cream at a discount of 30%.
                </span>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="bg-white py-8 px-6">
            <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-8 md:w-2/5 text-center mx-auto">
                <Link :href="route('register', { refID: 'web' })" class="bg-yellow-300 py-4 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400">
                    SIGN UP NOW
                </Link>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { defineProps, onMounted } from 'vue';
</script>

<style scoped>
header {
    font-family: 'Poppins', sans-serif;
}
</style>
