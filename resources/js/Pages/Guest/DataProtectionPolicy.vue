<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <GuestLayout>
        <Head title="Data Protection Policy" />

        <div class="py-12 px-6 bg-gray-50 rounded-xl shadow-2xl mx-auto md:px-12">
            <div class="text-left mb-10">

                <!-- Data Protection Policy Title -->
                <h1 class="text-4xl font-bold text-red-600 mb-6 font-heading tracking-wide">
                    Data Protection Policy
                </h1>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Introduction
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    This is DCVEND’s Data Protection Policy for all our customers and users of our website, mobile app, and services. The purpose of this policy is to inform you of how we manage and safeguard your personal data, as per the applicable Personal Data Protection Act.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Your Consent
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    By interacting with us, submitting information to us, or signing up for any products or services, you agree and consent to DCVEND (including its related entities and representatives) collecting, using, and disclosing your personal data as outlined in this Data Protection Policy.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Our Commitment
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    We prioritize the protection of your personal data. Reasonable security arrangements are in place to prevent unauthorized access, use, or disclosure. Our partners and third parties are required to comply with our Data Protection Policy. While we strive to enforce compliance, we are not liable for breaches outside of our reasonable control.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Collection of Personal Data
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    Personal data may include your name, contact information, payment details, and any information provided during interactions with us. This data is collected when you use our services, contact customer support, participate in promotions, or provide referrals. Ensure that the data provided is accurate and complete to avoid disruptions in service.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Use of Personal Data
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    Your data is used for the following purposes:
                    responding to inquiries, facilitating services, processing transactions, managing accounts, and improving service quality. We may also use your data for legal and regulatory compliance.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Disclosure of Personal Data
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    Personal data may be shared with our affiliates, service providers, and regulatory bodies where necessary. We ensure reasonable security measures are taken to protect your data.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Retention of Personal Data
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    Data is retained as long as necessary to provide our services or as required by law. You may request data access or deletion by contacting us.
                </p>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-red-500 mb-2 font-heading tracking-wide">
                    Governing Law
                </h2>
                <p class="text-md text-gray-700 leading-relaxed">
                    This Data Protection Policy is governed by the laws applicable to our operations.
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
</style>
