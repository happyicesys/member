<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <GuestLayout>
        <Head title="Welcome to DCVend" />

        <div class="container py-12 px-6 bg-gray-50 rounded-xl shadow-2xl mx-auto max-w-3xl">
            <div class="text-center mb-5 relative">
                <div class="flex items-center justify-center mx-auto">
                    <span>
                        <img src="/images/dcvend_mascot_01.png" alt="Mascot" class="w-24 h-24 opacity-80" />
                    </span>
                    <span>
                        <img src="/images/dcvend_mascot_02.png" alt="Mascot" class="w-24 h-24 opacity-80" />
                    </span>
                    <span>
                        <img src="/images/dcvend_mascot_03.png" alt="Mascot" class="w-24 h-24 opacity-80" />
                    </span>
                    <span>
                        <img src="/images/dcvend_mascot_04.png" alt="Mascot" class="w-24 h-24 opacity-80" />
                    </span>
                </div>
                <!-- Logo Component -->
                <ApplicationLogo class="mx-auto mt-10 mb-10 w-32 h-auto" />

                <!-- Welcome Title -->
                <h1 class="text-5xl font-extrabold text-red-400 mb-6 font-heading tracking-wide">
                    Premium Ice Cream Anytime, Anywhere
                </h1>

                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    Sign up now to enjoy up to 50% off on your favorite ice creams and exclusive vouchers. Conveniently order through our app or grab one instantly from a vending machine near you.
                </p>
            </div>

            <div class="mb-8 relative">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">Why Join DCVend?</h2>
                <ul class="list-disc list-inside text-gray-700 leading-relaxed">
                    <li><strong>Save More:</strong> Enjoy 33% off with a basic membership or upgrade to VIP for 50% off.</li>
                    <li><strong>Exclusive Perks:</strong> Access to premium and unique ice cream flavors.</li>
                    <li><strong>Convenience:</strong> Vending machines near you, available 24/7.</li>
                </ul>
            </div>

            <div class="mb-8 relative">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">How It Works</h2>
                <ol class="list-decimal list-inside text-gray-700 leading-relaxed">
                    <li>Sign up for free and explore our offerings.</li>
                    <li>Subscribe to a membership plan to unlock discounts and rewards.</li>
                    <li>Enjoy your ice cream from vending machines or through delivery.</li>
                </ol>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">Membership Plans</h2>
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Basic Membership</h3>
                        <p class="text-gray-600">
                            Enjoy 5% off on all ice creams and access to exclusive member-only flavors.
                        </p>
                        <p class="mt-4 text-red-400 font-semibold">Free to Join</p>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">VIP Membership</h3>
                        <p class="text-gray-600">
                            Get 50% off on all ice creams and receive free vouchers monthly for special promotions.
                        </p>
                        <p class="mt-4 text-red-400 font-semibold">$3.30/Month</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <Link
                    :href="route('register')"
                    class="bg-red-400 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-red-500">
                    Sign Up Now
                </Link>

                <p class="mt-4 text-gray-600">
                    Already a member? <Link :href="route('login')" class="text-red-400 underline hover:text-red-500">Log in</Link>
                </p>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap');

.font-heading {
    font-family: 'Poppins', sans-serif;
}
.container {
    max-width: 800px;
    margin: auto;
}
</style>
