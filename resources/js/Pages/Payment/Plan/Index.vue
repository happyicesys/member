<script setup>
import { usePage, useForm, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    plans: [Array, Object], // List of plans
    planItemUser: Object, // Current user's plan details
    needsPaymentMethod: Boolean, // Whether the user needs to bind a card
    userHasAnyPaymentMethod: Boolean, // Whether the user has a default payment method
});

const billingPortalUrl = ref('/billing-portal'); // Stripe Billing Portal URL
const plans = ref([]);
const planItemUser = ref([]);
const form = useForm({
    plan_id: '', // Pre-fill with the selected plan
});

// Load plans when the component is mounted
onMounted(() => {
    plans.value = props.plans.data;
    planItemUser.value = props.planItemUser.data;
    form.plan_id = planItemUser.value.plan_id; // Ensure it does not default to undefined
});

// Find the selected plan's details
const selectedPlanDetails = computed(() => {
    return plans.value.find((plan) => plan.id === form.plan_id);
});

// Find the current plan's details
const currentPlanDetails = computed(() => {
    return plans.value.find((plan) => plan.id === planItemUser.value.plan_id);
});

const needsCard = computed(() => {
    return props.needsPaymentMethod && !props.userHasAnyPaymentMethod;
});

// Determine button label dynamically based on `plan.level`
const buttonLabel = computed(() => {
    if (!currentPlanDetails.value) return 'Subscribe';
    if (form.plan_id === currentPlanDetails.value.id) return 'Subscribed';
    if (selectedPlanDetails.value.level > currentPlanDetails.value.level) return 'Upgrade Plan';
    if (selectedPlanDetails.value.level < currentPlanDetails.value.level) return 'Downgrade Plan';
    return 'Subscribe';
});

// Determine if button should be disabled
const isButtonDisabled = computed(() => !form.plan_id || form.plan_id === currentPlanDetails.value?.id);

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

    form.post('/plan/subscribe', {
        preserveScroll: true,
        onSuccess: () => alert('Subscription successful!'),
        onError: (errors) => console.error(errors),
    });
};


// Handle plan selection
const onPlanClicked = (plan) => {
    if (!plan.is_available) return;
    form.plan_id = plan.id;
};
</script>


<template>
    <AuthenticatedLayout>
        <Head title="Plan" />
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
                            <div class="flex-1 pr-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ plan.name }}</h3>
                                <p class="text-gray-600 whitespace-pre-line">{{ plan.description }}</p>
                                <p class="mt-2 text-red-400 font-semibold">
                                    {{ plan.price > 0 ? `$${plan.price.toFixed(2)} per month` : 'Free' }}
                                </p>
                            </div>
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

                    <!-- Show "Bind Card" button if needed -->
                    <!-- <div v-if="needsCard" class="mt-6 text-center">
                        <a
                            :href="billingPortalUrl"
                            class="bg-blue-400 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-blue-500"
                        >
                            Bind Card
                        </a>
                    </div> -->
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

div[role="button"] {
    cursor: pointer;
}
</style>
