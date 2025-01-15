<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    plans: [Array, Object], // List of plans
    selectedPlan: Number, // Current selected plan ID
});

const plans = ref([]);

const form = useForm({
    plan_id: props.selectedPlan, // Pre-fill with the selected plan
});

// Handle plan update
const updatePlan = () => {
    form.post('/plans/update', {
        preserveScroll: true, // Keep scroll position
        onSuccess: () => alert('Plan updated successfully!'),
        onError: (errors) => console.error(errors),
    });
};

onMounted(() => {
    plans.value = props.plans.data;
});
</script>

<template>
    <div class="py-10 bg-gray-50">
        <div class="mx-auto max-w-3xl px-6">
            <h2 class="text-3xl font-bold text-red-400 mb-6 font-heading text-center">Choose Your Plan</h2>

            <div>
                <div class="space-y-4">
                    <!-- <div
                        v-for="plan in plans"
                        :key="plan.id"
                        :class="[
                            'p-6 bg-white rounded-lg shadow-md flex items-center justify-between border-2',
                            form.plan_id === plan.id || plan.is_available ? 'border-red-400' : 'border-gray-200',
                            plan.is_available ? '' : 'opacity-50',
                        ]"
                        @click="form.plan_id = plan.id"
                    > -->
                    <div
                        v-for="plan in plans"
                        :key="plan.id"
                        :class="[
                            'p-6 bg-white rounded-lg shadow-md flex items-center justify-between border-2',
                            plan.is_available ? 'border-red-400' : 'border-gray-200',
                            plan.is_available ? '' : 'opacity-50',
                        ]"
                        @click="form.plan_id = plan.id"
                    >
                        <div class="flex-1 pr-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ plan.name }}</h3>
                            <p class="text-gray-600 whitespace-pre-line">{{ plan.description }}</p>
                            <p class="mt-2 text-red-400 font-semibold">
                                {{ plan.price > 0 ? `$${(plan.price).toFixed(2)} per month` : 'Free' }}
                            </p>
                        </div>
                        <!-- <div class="w-24 text-right">
                            <span
                                v-if="form.plan_id === plan.id"
                                class="text-red-400 font-semibold"
                            >
                                Chosen
                            </span>
                        </div> -->
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <!-- <button
                        @click="updatePlan"
                        class="bg-red-400 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-red-500"
                        :disabled="form.processing"
                    >
                        Save Plan
                    </button> -->
                    <button
                        @click="updatePlan"
                        class="bg-gray-400 text-white font-bold py-3 px-6 rounded-lg shadow-md cursor-not-allowed"
                        disabled
                    >
                        Save Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>



<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap');

.font-heading {
    font-family: 'Poppins', sans-serif;
}

input[type='radio']:checked + label {
    font-weight: bold;
    color: #dc2626; /* Tailwind red-400 */
}

div[role="button"] {
    cursor: pointer;
}
</style>

