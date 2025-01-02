<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <GuestLayout>
        <Head title="Terms & Conditions" />

        <div class="container py-12 px-6 bg-gray-50 rounded-xl shadow-2xl mx-auto max-w-3xl">
            <div class="text-center mb-10">
                <!-- Logo Component -->
                <ApplicationLogo class="mx-auto mb-4 w-32" />

                <!-- Terms & Conditions Title -->
                <h1 class="text-5xl font-extrabold text-red-400 mb-6 font-heading tracking-wide">
                    Terms & Conditions
                </h1>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    1. Availability
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    1.1 Our site is only intended for use by people, businesses, and companies residing in Singapore. We do not accept orders from individuals outside of Singapore.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    2. Your Status
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    2.1 By placing an order through our website, you warrant that:
                </p>
                <ul class="list-disc pl-6 text-lg text-gray-700 leading-relaxed">
                    <li>You are legally capable of entering into binding contracts.</li>
                    <li>You are a resident in Singapore.</li>
                </ul>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    3. How the Contract is Formed Between You and Us
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    3.1 After placing an online order, you will receive an email from us acknowledging receipt of your order. Please note that this does not mean that your order has been accepted. Your order constitutes an offer to us to buy a product. The contract between us will only be formed when we deliver the items to you.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    3.2 Subject to actual stock availability, item orders will be replaced with alternatives subject to verbal or written confirmation with you.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    3.3 All orders placed online will be fulfilled within fourteen business days unless otherwise advised. Business days exclude Saturdays, Sundays, and Public Holidays.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    3.4 You are obliged to make payment in FULL by the payment option you select when you check out your orders.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    4. Price and Payment
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    4.1 The price of any products will be as quoted on our site from time to time, except in cases of obvious error.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    4.2 If a product’s correct price is higher than the stated price on our site, we may contact you for instructions before dispatching the product or reject your order and notify you of such rejection.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    5. Refunds/Returns
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    We appreciate that all customers (or third parties representing you) check the completeness of their order upon delivery. We are unable to exchange, return, or refund orders once they have been received and signed for upon delivery.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Should you have any dissatisfaction regarding your order, please email us at <a href="mailto:care@dcvend.com" class="text-blue-500 underline">care@dcvend.com</a> or WhatsApp us at 65631692. For food safety reasons, exchange, return, or refund is only available within three days from the date of delivery.
                </p>
            </div>

            <div>
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">
                    6. Law and Jurisdiction
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Contracts for the purchase of products through our site will be governed by the laws of Singapore. Any dispute arising from or related to such contracts shall be subject to the non-exclusive jurisdiction of the Courts of the Republic of Singapore.
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
