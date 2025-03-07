<script setup>
import { useForm, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { computed, ref, watch } from "vue";
import { format } from "date-fns"; // Ensure you have date-fns installed

const props = defineProps({
    selectedPlan: Object, // The plan the user wants to downgrade to
    currentPlanItemUser: Object, // The latest PlanItemUser with plan details
});

// **Use computed properties to access plan details safely**
const currentPlan = computed(() => props.currentPlanItemUser?.data?.plan || {});
const selectedPlan = computed(() => props.selectedPlan?.data || {});

// **Format plan end date for display**
const planEndDateFormatted = computed(() => {
    const rawDate = props.currentPlanItemUser?.data?.datetime_to;
    return rawDate ? format(new Date(rawDate), "MMMM dd, yyyy") : "Unknown";
});

// **Initialize form for downgrade request**
const form = useForm({
    plan_id: selectedPlan.value.id || "",
});

// **Watch for plan changes and update form**
watch(selectedPlan, (newPlan) => {
    form.plan_id = newPlan?.id || "";
});

// **Loading state to prevent multiple clicks**
const isLoading = ref(false);

// **Proceed with the downgrade**
const confirmDowngrade = () => {
    if (!window.confirm("Are you sure you want to downgrade? This will take effect after the current billing cycle.")) {
        return;
    }

    isLoading.value = true;

    form.post("/plan/downgrade", {
        preserveScroll: true,
        onSuccess: () => {
            alert("Your downgrade request has been scheduled.");
            router.visit("/dashboard");
        },
        onError: (errors) => {
            console.error(errors);
            alert("Failed to process downgrade. Please try again.");
        },
        onFinish: () => {
            isLoading.value = false;
        }
    });
};

// **Cancel and go back to plan selection**
const cancelDowngrade = () => {
    router.visit("/plan");
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Confirm Downgrade" />

        <div class="py-10 bg-gray-50">
            <div class="mx-auto max-w-3xl px-6">
                <h2 class="text-3xl font-bold text-red-500 mb-6 text-center">
                    Are You Sure You Want to Downgrade?
                </h2>

                <div class="p-6 bg-white rounded-lg shadow-lg border-2 border-gray-200 text-center">
                    <p class="text-gray-700 text-lg">
                        You're about to switch from
                        <span class="font-bold text-red-500">{{ currentPlan.name || "Your Current Plan" }}</span>
                        to
                        <span class="font-bold text-blue-500">{{ selectedPlan.name || "Selected Plan" }}</span>.
                    </p>

                    <p class="mt-4 text-sm text-gray-600">
                        Downgrading may remove some premium features. Would you like to continue?
                    </p>

                    <!-- **New Line: Display the plan's end date before downgrade takes effect** -->
                    <p class="mt-2 text-sm text-gray-500">
                        Your current plan will remain active until <span class="font-semibold">{{ planEndDateFormatted }}</span>.
                    </p>

                    <div class="mt-6 flex flex-col items-center">
                        <div class="flex space-x-4">
                            <button
                                @click="confirmDowngrade"
                                :disabled="isLoading"
                                class="bg-red-500 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-red-600 transition duration-200 disabled:opacity-50"
                            >
                                {{ isLoading ? "Processing..." : "Yes, Downgrade" }}
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
    font-family: "Poppins", sans-serif;
}
</style>
