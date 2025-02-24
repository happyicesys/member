<script setup>
import { useForm, usePage, router } from '@inertiajs/vue3';
import { loadStripe } from '@stripe/stripe-js';
import { ref, onMounted, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Receive Stripe Key from Laravel
const props = defineProps({
    stripeKey: String, // Passed from Laravel (via Inertia)
    plans: Object, // All available plans
    planID: String, // Current user's plan ID
});

// Get selected plan from query parameter
const page = usePage();
const selectedPlanId = ref(page.props.planID);

// Find the selected plan details
const selectedPlan = computed(() => {
    return props.plans.data.find(plan => plan.id == selectedPlanId.value);
});

// Redirect if no plan is selected
onMounted(() => {
    if (!selectedPlan.value) {
        alert('No plan selected. Redirecting to plan selection...');
        router.visit('/plan');
    }

    // If the plan does not require payment, subscribe directly
    if (!selectedPlan.value.is_required_payment) {
        form.post('/plan/subscribe', {
            plan_id: selectedPlanId.value,
            preserveScroll: true,
            onSuccess: () => {
                alert('Subscribed successfully!');
                router.visit('/dashboard');
            },
            onError: (errors) => console.error(errors),
        });
    }
});


// Initialize Stripe
const stripePromise = loadStripe(props.stripeKey);
const stripe = ref(null);
const cardElement = ref(null);
const card = ref(null);
const form = useForm({ plan_id: selectedPlanId.value });

onMounted(async () => {
    stripe.value = await stripePromise;
    const elements = stripe.value.elements();

    card.value = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                fontFamily: 'Poppins, sans-serif',
                color: '#333',
            },
        },
    });

    card.value.mount(cardElement.value);
});

// Handle payment and subscribe user
const handlePayment = async () => {
    if (!selectedPlan.value) {
        alert('Please select a plan before proceeding.');
        return;
    }

    const { paymentMethod, error } = await stripe.value.createPaymentMethod({
        type: 'card',
        card: card.value,
    });

    if (error) {
        alert(error.message);
    } else {
        form.post('/plan/subscribe', {
            payment_method: paymentMethod.id,
            plan_id: selectedPlanId.value, // Send selected plan ID
            preserveScroll: true,
            onSuccess: () => {
                alert('Payment successful! Subscription activated.');
                router.visit('/dashboard'); // Redirect back to plan selection
            },
            onError: (errors) => {
                console.error(errors);
                alert('Payment failed. Please try again.');
            },
        });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Payment Setup" />

        <div class="py-10 bg-gray-50">
            <div class="mx-auto max-w-3xl px-6">
                <h2 class="text-3xl font-bold text-red-400 mb-6 font-heading text-center">
                    Confirm Your Subscription
                </h2>

                <!-- Plan Summary -->
                <div class="p-6 bg-white rounded-lg shadow-md border-2 border-gray-200 mb-6">

                    <div v-if="selectedPlan" class="text-center">
                        <h4 class="text-lg font-semibold text-gray-700 pb-3">{{ selectedPlan.name }}</h4>
                        <p class="text-gray-600 whitespace-pre-line pb-5">{{ selectedPlan.description }}</p>
                        <p class="mt-2 text-red-500 font-bold">
                            {{ selectedPlan.price > 0 ? `$${selectedPlan.price.toFixed(2)} per month` : 'Free' }}
                        </p>
                    </div>

                    <div v-else class="text-center text-gray-500">
                        No plan selected. Redirecting...
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="p-6 bg-white rounded-lg shadow-md border-2 border-gray-200">
                    <p class="text-gray-600 text-center mb-4">
                        Enter your card details below to proceed with the payment.
                    </p>

                    <!-- Stripe Card Element -->
                    <div ref="cardElement" class="border rounded-lg p-4 bg-gray-50"></div>
                    <!-- <p class="pt-2">Powered by Stripe</p> -->
                    <div class="flex justify-start pt-3">
                        <img src="/images/powered_by_stripe_1.png" alt="Powered by Stripe Icon" class="w-1/4 lg:w-1/6" />
                    </div>
                    <!-- Proceed Button -->
                    <div class="mt-6 text-center">
                        <button
                            @click="handlePayment"
                            class="bg-green-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-green-600 transition duration-200"
                        >
                            Proceed to Payment
                        </button>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-4 text-center">
                        <a href="/plan" class="text-gray-500 hover:text-blue-600 text-sm">Go back to Plan Selection</a>
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
