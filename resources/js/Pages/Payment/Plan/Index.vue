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
    plans.value = props.plans.data.filter((plan) => plan.is_active || plan.id == planItemUser.value.plan_id);
});

// Find the selected plan's details
const selectedPlanDetails = computed(() => {
    return plans.value.find((plan) => plan.id === form.plan_id);
});

// Find the current plan's details
const currentPlanDetails = computed(() => {
    return plans.value.find((plan) => plan.id === planItemUser.value.plan_id);
});

const buttonLabel = (plan) => {
    if (processing.value) return 'Processing...';
    if (!currentPlanDetails.value) return 'Subscribe';
    if (plan.id === currentPlanDetails.value.id) return 'Subscribed';
    if (plan.level > currentPlanDetails.value.level) return 'Upgrade';
    if (plan.level < currentPlanDetails.value.level) return 'Downgrade';
    return 'Subscribe';
};

const isButtonDisabled = (plan) => {
    return !plan.id || plan.id === currentPlanDetails.value?.id || processing.value;
};

const handleSubscription = (plan_id) => {
    form.plan_id = plan_id;

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

    processing.value = true;
    form.post('/plan/subscribe', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Subscription successful!');
            processing.value = false;
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
                        <div v-for="plan in plans" :key="plan.id"
                            :class="[
                                'p-6 bg-white rounded-lg shadow-md flex flex-col md:flex-row items-center justify-between border-2 cursor-pointer transition duration-200',
                                form.plan_id === plan.id ? 'border-red-400 bg-red-50' : 'border-gray-200',
                                plan.is_available ? '' : 'opacity-50 cursor-not-allowed',
                            ]"
                            @click="onPlanClicked(plan)"
                        >
                            <div class="flex flex-col space-y-3 pr-4">
                                <h3 class="text-xl font-bold text-gray-800 flex items-center space-x-2">
                                    <div class="text-2xl">{{ plan.name }}</div>
                                    <span class="bg-yellow-300 py-2 px-4 rounded-md border-2 border-red-600 text-red-600 font-bold text-md hover:bg-yellow-400"
                                        v-if="planItemUser.plan_id === plan.id">
                                        Current
                                    </span>
                                </h3>
                                <p class="text-gray-600 whitespace-pre-line">{{ plan.description }}</p>
                                <p class="mt-2 text-lg text-red-400 font-semibold">
                                    {{ plan.price > 0 ? `$${plan.price.toFixed(2)} per month` : 'Free' }}
                                </p>
                                <span v-if="planItemUser.plan_id === plan.id && !planItemUser.scheduled_downgrade_plan_id" class="text-gray-800 text-left text-md font-medium">
                                    **Your plan will be renewed on <strong>{{ planItemUser.date_to }}</strong>
                                </span>
                                <span v-if="planItemUser.plan_id === plan.id && planItemUser.scheduled_downgrade_plan_id" class="text-gray-800 text-left text-md font-medium">
                                    **Your plan will be expired on <strong>{{ planItemUser.date_to }}</strong>. <br>
                                    You will be downgraded to the <strong>{{ planItemUser.scheduledDowngradePlan.name }}</strong> plan.
                                </span>
                            </div>

                            <!-- Action Button next to each plan -->
                            <button @click.stop="handleSubscription(plan.id)"
                                v-if="planItemUser.scheduled_downgrade_plan_id !== plan.id && plan.is_available"
                                class="font-bold mt-8 md:mt-1 py-3 px-6 rounded-lg shadow-md transition duration-200"
                                :class="{
                                    'bg-green-400 hover:bg-green-500 text-white': buttonLabel(plan) === 'Subscribe',
                                    'bg-green-400 hover:bg-green-500 text-white': buttonLabel(plan).includes('Upgrade'),
                                    'bg-yellow-400 hover:bg-yellow-500 text-white': buttonLabel(plan).includes('Downgrade'),
                                    'bg-yellow-300 border-2 border-red-600 text-red-600 font-bold cursor-not-allowed': buttonLabel(plan) === 'Subscribed',
                                    'bg-gray-400 cursor-not-allowed text-white': isButtonDisabled(plan) && buttonLabel(plan) !== 'Subscribed',
                                }"


                                :disabled="isButtonDisabled(plan)">
                                {{ buttonLabel(plan) }}
                            </button>
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
