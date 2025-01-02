<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    plans: Object, // Dynamic plans data from the controller
});

const plans = ref([]);

onMounted(() => {
    plans.value = props.plans.data;
});
</script>

<template>
    <GuestLayout>
        <Head title="Welcome to DCVend" />

        <div class="container py-12 px-6 bg-gray-50 rounded-xl shadow-2xl mx-auto max-w-3xl">
            <!-- Welcome Section -->
            <div class="text-center mb-5 relative">
                <div class="flex items-center justify-center mx-auto">
                    <span><img src="/images/dcvend_mascot_01.png" alt="Mascot" class="w-24 h-24 opacity-80" /></span>
                    <span><img src="/images/dcvend_mascot_02.png" alt="Mascot" class="w-24 h-24 opacity-80" /></span>
                    <span><img src="/images/dcvend_mascot_03.png" alt="Mascot" class="w-24 h-24 opacity-80" /></span>
                    <span><img src="/images/dcvend_mascot_04.png" alt="Mascot" class="w-24 h-24 opacity-80" /></span>
                </div>
                <ApplicationLogo class="mx-auto mt-10 mb-10 w-32 h-auto" />
                <h1 class="text-5xl font-extrabold text-red-400 mb-6 font-heading tracking-wide">Premium Ice Cream Anytime, Anywhere</h1>
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    Sign up now to enjoy up to 50% off on your favorite ice creams and exclusive vouchers. Conveniently order through our app or grab one instantly from a vending machine near you.
                </p>
            </div>

            <!-- Why Join Section -->
            <div class="mb-8 relative">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">Why Join DCVend?</h2>
                <ul class="list-disc list-inside text-gray-700 leading-relaxed">
                    <li><strong>Save More:</strong> Enjoy 33% off with a basic membership or upgrade to VIP for 50% off.</li>
                    <li><strong>Exclusive Perks:</strong> Access to premium and unique ice cream flavors.</li>
                    <li><strong>Convenience:</strong> Vending machines near you, available 24/7.</li>
                </ul>
            </div>

            <!-- How It Works Section -->
            <div class="mb-8 relative">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">How It Works</h2>
                <ol class="list-decimal list-inside text-gray-700 leading-relaxed">
                    <li>Sign up for free and explore our offerings.</li>
                    <li>Subscribe to a membership plan to unlock discounts and rewards.</li>
                    <li>Enjoy your ice cream from vending machines or through delivery.</li>
                </ol>
            </div>

            <!-- Membership Plans Section -->
            <div class="mb-8">
                <h2 class="text-3xl font-semibold text-yellow-500 mb-4 font-heading tracking-wide">Membership Plans</h2>
                <div class="overflow-x-auto">
                    <div class="flex gap-2 md:flex-nowrap">
                        <!-- Dynamic Membership Plans -->
                        <div
                            v-for="plan in plans"
                            :key="plan.id"
                            class="flex-shrink-0 w-52 p-4 bg-white rounded-lg shadow-md"
                        >
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ plan.name }}</h3>
                            <p class="text-gray-600 whitespace-pre-line">{{ plan.description }}</p>
                            <p class="mt-4 text-red-400 font-semibold">
                                {{ plan.price > 0 ? `$${(plan.price).toFixed(2)}/month` : 'Free to Join' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Call to Action Section -->
            <div class="text-center">
                <Link
                    :href="route('register')"
                    class="bg-red-400 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-red-500"
                >
                    Sign Up Now
                </Link>
                <p class="mt-4 text-gray-600">
                    Already a member? <Link :href="route('login')" class="text-red-400 underline hover:text-red-500">Log in</Link>
                </p>
            </div>

            <!-- Footer Links -->
            <div class="rounded-lg mt-10 p-4">
                <div class="flex flex-col md:flex-row gap-4 justify-center items-stretch">
                    <a
                        class="flex items-center justify-center px-4 py-3 bg-yellow-300 text-gray-800 rounded-lg shadow-md transition duration-200 ease-in-out hover:bg-yellow-400 hover:shadow-lg"
                        :href="route('about')"
                    >
                        About
                    </a>
                    <a
                        class="flex items-center justify-center px-4 py-3 bg-yellow-300 text-gray-800 rounded-lg shadow-md transition duration-200 ease-in-out hover:bg-yellow-400 hover:shadow-lg"
                        :href="route('terms-and-conditions')"
                    >
                        T&C
                    </a>
                    <a
                        class="flex items-center justify-center px-4 py-3 bg-yellow-300 text-gray-800 rounded-lg shadow-md transition duration-200 ease-in-out hover:bg-yellow-400 hover:shadow-lg"
                        :href="route('privacy-policy')"
                    >
                        Privacy Policy
                    </a>
                </div>
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
