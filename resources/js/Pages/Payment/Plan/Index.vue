<script setup>
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const plans = ref([]);
const selectedPlan = ref(null);
const loading = ref(true);
const user = usePage().props.auth.user;

// Fetch plans and user's selected plan
const fetchPlans = async () => {
    try {
        const response = await axios.get('/api/plans'); // Adjust the API endpoint as needed
        plans.value = response.data.plans;
        selectedPlan.value = user.plan_id; // Assume `plan_id` is available in user data
    } catch (error) {
        console.error('Failed to fetch plans:', error);
    } finally {
        loading.value = false;
    }
};

// Update user's selected plan
const updatePlan = async () => {
    try {
        loading.value = true;
        await axios.put('/api/plans/switch', { plan_id: selectedPlan.value });
        alert('Plan updated successfully!');
    } catch (error) {
        console.error('Failed to update plan:', error);
        alert('Failed to update plan. Please try again.');
    } finally {
        loading.value = false;
    }
};

// Fetch plans on mount
onMounted(fetchPlans);
</script>

<template>
    <div class="py-10 bg-gray-50">
        <div class="mx-auto max-w-3xl px-6">
            <h2 class="text-3xl font-bold text-red-400 mb-6 font-heading text-center">Choose Your Plan</h2>

            <div v-if="loading" class="text-center">
                <p class="text-gray-600">Loading plans...</p>
            </div>

            <div v-else>
                <div class="space-y-4">
                    <div
                        v-for="plan in plans"
                        :key="plan.id"
                        class="p-6 bg-white rounded-lg shadow-md flex items-center justify-between"
                    >
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ plan.name }}</h3>
                            <p class="text-gray-600">{{ plan.description }}</p>
                            <p class="mt-2 text-red-400 font-semibold">{{ plan.price > 0 ? `$${plan.price}/month` : 'Free' }}</p>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :id="`plan-${plan.id}`"
                                :value="plan.id"
                                v-model="selectedPlan"
                                class="w-5 h-5 text-red-400 border-gray-300 focus:ring-red-400"
                            />
                            <label :for="`plan-${plan.id}`" class="ml-2 text-gray-700">Select</label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button
                        @click="updatePlan"
                        class="bg-red-400 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-red-500"
                        :disabled="loading"
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
</style>
