<script setup>
import { usePage, useForm, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    selectedPlan: Object, // The plan the user wants to downgrade to
    currentPlanItemUser: Object, // The latest PlanItemUser with plan details
});

const currentPlan = ref([]);
const currentPlanItemUser = ref([]);
const selectedPlan = ref([]);
const form = useForm(getDefaultForm())

onMounted(() => {
    currentPlan.value = props.currentPlanItemUser.data.plan;
    currentPlanItemUser.value = props.currentPlanItemUser.data;
    selectedPlan.value = props.selectedPlan.data;
    form.plan_id = selectedPlan.value.id;
});

// Proceed with the downgrade
const confirmDowngrade = () => {
    form.post('/plan/downgrade', {
        preserveScroll: true,
        onSuccess: () => {
            alert('Your plan has been downgraded.');
            router.visit('/dashboard');
        },
        onError: (errors) => console.error(errors),
    });
};

// Cancel and go back
const cancelDowngrade = () => {
    router.visit('/plan');
};

// Handle retention offer (if available)
const acceptRetentionOffer = () => {
    alert('You have chosen to stay on your current plan with a special discount!');
    router.visit('/plan');
};

function getDefaultForm() {
  return {
    plan_id: '',
  }
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Confirm Downgrade" />

        <div class="py-10 bg-gray-50">
            <div class="mx-auto max-w-3xl px-6">
                <h2 class="text-3xl font-bold text-red-500 mb-6 text-center">Are You Sure You Want to Downgrade?</h2>

                <div class="p-6 bg-white rounded-lg shadow-md border-2 border-gray-200 text-center">
                    <p class="text-gray-700">
                        You're about to switch from
                        <span class="font-bold text-red-500">{{ currentPlan.name }}</span>
                        to
                        <span class="font-bold text-blue-500">{{ selectedPlan.name }}</span>.
                    </p>

                    <p class="mt-4 text-sm text-gray-600">
                        Downgrading may remove some premium features. Would you like to continue?
                    </p>

                    <div class="mt-6 flex flex-col items-center">
                        <div class="flex space-x-4">
                            <button
                                @click="confirmDowngrade"
                                class="bg-red-500 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-red-600 transition duration-200"
                            >
                                Yes, Downgrade
                            </button>
                            <button
                                @click="cancelDowngrade"
                                class="bg-gray-400 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-gray-500 transition duration-200"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.font-heading {
    font-family: 'Poppins', sans-serif;
}
</style>
