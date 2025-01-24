<script setup>
import { ref, computed, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ChevronRightIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    transactedCountry: Object,
    vendTransactions: Object,
});

const transactedCountry = ref([])
const vendTransactions = ref([]);

onMounted(() => {
    transactedCountry.value = props.transactedCountry.data;
    vendTransactions.value = props.vendTransactions.data;
});

const operatorCountry = usePage().props.auth.operatorCountry;

// Compute total saved amount
const totalSaved = computed(() => {
    return vendTransactions.value.reduce((sum, transaction) => sum + transaction.total_promo_amount, 0);
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="History" />

        <div class="py-4 bg-gray-100">
            <div class="mx-auto px-6 sm:px-8 lg:px-12">

                <!-- Total Stats Section -->
                <div class="bg-white py-12 sm:py-16 mb-10 shadow rounded-lg w-fit mx-auto">
                    <div class="mx-auto px-12 lg:px-10 flex items-center space-x-2">
                        <!-- <dl class="grid grid-cols-1 text-center lg:grid-cols-3"> -->
                            <section class="text-white rounded">
                                <img src="/images/icon.png" alt="Vion Icon" class="w-36 rounded mx-auto" />
                            </section>
                            <div class="mx-auto flex max-w-md flex-col">
                                <dt class="text-base/7 text-gray-700">You have saved</dt>
                                <dd class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                                    {{ transactedCountry.currency_symbol }} {{ totalSaved.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}
                                </dd>
                            </div>
                        <!-- </dl> -->
                    </div>
                </div>

                <!-- Transaction History List -->
                <h1 class="text-2xl font-bold text-red-700 mb-6 px-2">Transaction History</h1>
                <ul role="list" class="divide-y divide-gray-300 bg-white shadow rounded-lg">
                    <li
                        v-for="transaction in vendTransactions"
                        :key="transaction.id"
                        class="relative py-5 hover:bg-gray-50"
                    >
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h2 class="text-lg font-semibold text-gray-700 flex space-x-2 items-center">
                                        <span>
                                            {{ transaction.customer_name }}
                                        </span>
                                        <small class="text-xs text-gray-500">({{ transaction.datetime_for_humans }})</small>
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Amount:
                                        {{ transactedCountry.currency_symbol }} {{ (transaction.total_amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}
                                    </p>
                                    <p class="text-sm text-gray-800">
                                        Saved:
                                        {{ transactedCountry.currency_symbol }} {{ (transaction.total_promo_amount).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}
                                    </p>
                                    <div class="mt-4">
                                        <ul class="mt-2 space-y-2">
                                            <li
                                                v-for="item in transaction.vendTransactionItems"
                                                :key="item.id"
                                                class="flex items-center gap-x-4"
                                            >
                                                <img
                                                    :src="item.product_thumbnail_url"
                                                    alt="Product Image"
                                                    class="h-20 w-20 rounded-lg border bg-gray-200"
                                                />
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ item.product_name }}
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.font-heading {
    font-family: 'Poppins', sans-serif;
}
</style>
