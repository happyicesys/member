<script setup>
import { usePage, useForm, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    allPaymentMethods: Object, // List of all payment methods
    plans: [Array, Object], // List of plans
    planItemUser: Object, // Current user's plan details
    needsPaymentMethod: Boolean, // Whether the user needs to bind a card
    userHasAnyPaymentMethod: Boolean, // Whether the user has a default payment method
    userPaymentMethods: Array, // User's saved payment methods
});

const allPaymentMethods = ref([]);
const plans = ref([]);
const planItemUser = ref([]);
const processing = ref(false); // Processing state
const form = useForm({
    plan_id: '', // Pre-fill with the selected plan
});

// Load plans when the component is mounted
onMounted(() => {
    allPaymentMethods.value = props.allPaymentMethods.data;
    planItemUser.value = props.planItemUser.data;
    form.plan_id = planItemUser.value.plan_id; // Ensure it does not default to undefined
    plans.value = props.plans.data.filter((plan) => plan.is_available || plan.id == planItemUser.value.plan_id);
});

// Find the selected plan's details
const selectedPlanDetails = computed(() => {
    return plans.value.find((plan) => plan.id === form.plan_id);
});

// Find the current plan's details
const currentPlanDetails = computed(() => {
    return plans.value.find((plan) => plan.id === planItemUser.value.plan_id);
});

// Determine button label dynamically based on `plan.level`
const buttonLabel = computed(() => {
    if (processing.value) return 'Processing...';
    if (!currentPlanDetails.value) return 'Subscribe';
    if (form.plan_id === currentPlanDetails.value.id) return 'Subscribed';
    if (selectedPlanDetails.value.level > currentPlanDetails.value.level) return 'Upgrade Plan';
    if (selectedPlanDetails.value.level < currentPlanDetails.value.level) return 'Downgrade Plan';
    return 'Subscribe';
});

// Determine if button should be disabled
const isButtonDisabled = computed(() => !form.plan_id || form.plan_id === currentPlanDetails.value?.id || processing.value);

const handleSubscription = () => {
    if (!form.plan_id) {
        alert('Please select a plan before proceeding.');
        return;
    }

    let selectedPlan = plans.value.find(plan => plan.id === form.plan_id);

    // Redirect to retention page if the user is downgrading
    if (selectedPlan.level < currentPlanDetails.value.level) {
        router.visit(`/plan/retention?plan_id=${form.plan_id}`);
        return;
    }

    if (selectedPlan.is_required_payment) {
        if (!props.userHasAnyPaymentMethod) {
            router.get(`/plan/payment?plan_id=${form.plan_id}`);
            return;
        }
    }

    processing.value = true; // Set processing state
    form.post('/plan/subscribe', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Subscription successful!');
            processing.value = false; // Reset processing state
            // **✅ Update current plan immediately**
            planItemUser.value.plan_id = form.plan_id;
        },
        onError: (errors) => console.error(errors),
    });
};

// Handle plan selection
const onPlanClicked = (plan) => {
    if (!plan.is_available) return;
    form.plan_id = plan.id;
};

// Get user's default payment method
const defaultPaymentMethod = computed(() => {
    return props.userPaymentMethods.length > 0 ? {...props.userPaymentMethods[0], ...allPaymentMethods.value.find((method) => method.slug == props.userPaymentMethods[0].card.display_brand )} : null;
});

// loop allPaymentMethods.value to get the default payment method and also set the default payment method
// const defaultPaymentMethod = computed(() => {
//     return props.userPaymentMethods.length > 0 ? [...allPaymentMethods.value].find((method) => method.id === props.userPaymentMethods[0].payment_method_id) : null;
// });

// Determine the card brand logo
const getCardBrandLogo = (brand) => {
    if (!brand) return null;
    const brandLower = brand.toLowerCase();
    if (brandLower.includes('visa')) return '/images/visa.svg';
    if (brandLower.includes('mastercard')) return '/images/mastercard.svg';
    if (brandLower.includes('amex')) return '/images/amex.svg';
    if (brandLower.includes('discover')) return '/images/discover.svg';
    return null;
};
</script>

<template>
    <Head title="Plan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Plan
            </h2>
        </template>

        <div class="py-10 bg-gray-50">
            <div class="mx-auto max-w-3xl px-6">
                <h2 class="text-3xl font-bold text-red-400 mb-6 font-heading text-center">Choose Your Plan</h2>

                <div>
                    <div class="space-y-4">
                        <div
                            v-for="plan in plans"
                            :key="plan.id"
                            :class="[
                                'p-6 bg-white rounded-lg shadow-md flex items-center justify-between border-2 cursor-pointer transition duration-200',
                                form.plan_id === plan.id ? 'border-red-400 bg-red-50' : 'border-gray-200',
                                plan.is_available ? '' : 'opacity-50 cursor-not-allowed',
                            ]"
                            @click="onPlanClicked(plan)"
                        >
                            <div class="flex justify-between items-center w-full">
                                <div class="flex flex-col space-y-3 pr-4">
                                    <h3 class="text-xl font-bold text-gray-800">{{ plan.name }}</h3>
                                    <p class="text-gray-600 whitespace-pre-line">{{ plan.description }}</p>
                                    <p class="mt-2 text-red-400 font-semibold">
                                        {{ plan.price > 0 ? `$${plan.price.toFixed(2)} per month` : 'Free' }}
                                    </p>
                                    <span v-if="planItemUser.plan_id === plan.id && !planItemUser.scheduled_downgrade_plan_id" class="text-gray-800 text-right text-sm font-medium">
                                        **Your plan will be renewed on <strong>{{ planItemUser.date_to }}</strong>
                                    </span>
                                    <span v-if="planItemUser.plan_id === plan.id && planItemUser.scheduled_downgrade_plan_id" class="text-gray-800 text-right text-sm font-medium">
                                        **Your plan will be expired on <strong>{{ planItemUser.date_to }}</strong>. You will be downgraded to the <strong>{{ planItemUser.scheduledDowngradePlan.name }}</strong> plan.
                                    </span>
                                </div>
                                <!-- Keep the badge at the rightmost -->
                                <span class="ml-auto inline-flex rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/40 w-fit h-fit" v-if="planItemUser.plan_id === plan.id">
                                    Current
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="mt-10 h-1 w-full bg-gray-300" v-if="defaultPaymentMethod"></div>


                    <!-- Payment Method Section -->
                    <div v-if="defaultPaymentMethod" class="p-6 m-6 md:m-12 bg-blue-50 shadow-lg rounded-lg border border-blue-400">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Your Default Payment Method</h3>
                        <div class="flex items-center gap-4">
                            <img :src="defaultPaymentMethod.attachment.full_url" alt="Visa Logo" class="w-12 h-12" v-if="defaultPaymentMethod.attachment">
                            <p class="text-blue-800 text-base font-medium">
                                ending in <span class="font-semibold">{{ defaultPaymentMethod.card.last4 }}</span>
                            </p>
                            <p class="text-gray-700 text-sm">Exp: {{ defaultPaymentMethod.card.exp_month }}/{{ defaultPaymentMethod.card.exp_year }}</p>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="/billing" class="text-blue-600 hover:underline text-md">
                                Manage Billing
                            </a>
                        </div>
                    </div>

                    <!-- Single Dynamic Button -->
                    <div class="mt-6 text-center">
                        <button
                            @click="handleSubscription"
                            class="text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-200"
                            :class="{
                                'bg-green-400 hover:bg-green-500': buttonLabel === 'Subscribe',
                                'bg-blue-400 hover:bg-blue-500': buttonLabel.includes('Upgrade'),
                                'bg-yellow-400 hover:bg-yellow-500': buttonLabel.includes('Downgrade'),
                                'bg-gray-400 cursor-not-allowed': isButtonDisabled,
                            }"
                            :disabled="isButtonDisabled"
                        >
                            {{ buttonLabel }}
                        </button>
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
