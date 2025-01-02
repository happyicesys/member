<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <GuestLayout>
        <Head title="Privacy Policy" />

        <div class="container py-12 px-6 bg-gray-50 rounded-xl shadow-2xl mx-auto max-w-3xl">
            <div class="text-center mb-10">
                <!-- Logo Component -->
                <ApplicationLogo class="mx-auto mb-4 w-32" />

                <!-- Privacy Policy Title -->
                <h1 class="text-5xl font-extrabold text-red-400 mb-6 font-heading tracking-wide">
                    Privacy Policy
                </h1>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Who We Are
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Our website address is: <a href="https://dcvend.com" class="text-blue-500 underline">https://dcvend.com</a>. DCVEND is a service operated by DCVIC PTE. LTD, focused on providing a membership subscription model for ice cream products via vending machines.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Payment Information
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    We use Stripe (via Laravel Cashier) to process payments for our monthly promotion packages. Your payment information is securely transmitted and stored by Stripe. For more information about Stripe’s privacy practices, visit <a href="https://stripe.com/privacy" class="text-blue-500 underline">Stripe Privacy Policy</a>.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Comments
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    When visitors leave comments on the site, we collect the data shown in the comments form, as well as the visitor’s IP address and browser user agent string to help with spam detection.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Cookies
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    If you leave a comment or sign up for a membership, cookies may be saved to your device to enhance your experience. For example, login cookies last for two days, and screen options cookies last for a year.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Embedded Content from Other Websites
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Articles or pages on this site may include embedded content (e.g., videos, images, or articles). Embedded content behaves in the same way as if the visitor has visited the external website. These external sites may collect data, use cookies, and track your interactions with the content.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    How Long We Retain Your Data
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    If you leave a comment, the comment and its metadata are retained indefinitely. For users who sign up for memberships, personal information is retained as long as your account is active, unless required by law to be stored longer.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    What Rights You Have Over Your Data
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    If you have an account or have left comments, you can request to receive an exported file of your personal data or request that we delete any personal data we hold. This does not include data we are obliged to keep for administrative or legal purposes.
                </p>
            </div>

            <div>
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    Where We Send Your Data
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Visitor comments may be checked through an automated spam detection service. Payment-related data is processed securely through Stripe.
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
