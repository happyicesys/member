<script setup>
import { ArrowDownTrayIcon, XMarkIcon } from '@heroicons/vue/20/solid'
import { Head, router, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { loadStripe } from '@stripe/stripe-js';
import moment from 'moment';
import { computed, ref, onMounted } from 'vue';

const props = defineProps({
    allPaymentMethods: Object,
    defaultPaymentMethod: Object,
    stripeKey: String,
    invoices: [Array, Object],
    userPaymentMethods: Array,
});

const stripe = ref(null);
const elements = ref(null);
const cardElement = ref(null);
const selectedMethod = ref(null);
const processing = ref(false);
const form = useForm({
    // payment_method: ''
});

// Initialize Stripe
onMounted(async () => {
    stripe.value = await loadStripe(props.stripeKey);
    elements.value = stripe.value.elements();
    cardElement.value = elements.value.create('card', { style: { base: { fontSize: '16px' } } });
    cardElement.value.mount('#card-element');
});

// Add Payment Method
const addPaymentMethod = async () => {
    processing.value = true;
    // const { token, error } = await stripe.value.createToken(cardElement.value);
    const { paymentMethod, error } = await stripe.value.createPaymentMethod({
        type: 'card',
        card: cardElement.value,
    });

    if (error) {
        alert(error.message);
        processing.value = false;
        return;
    }

    form.payment_method = paymentMethod.id;

    form.post(route('payment-methods.store'), {
        preserveScroll: true,
        onSuccess: () => {
            processing.value = false;
            cardElement.value.clear();
        }
    });
};

const deletePaymentMethod = (method) => {
    if (!confirm('Are you sure to remove this payment method?')) return;

    form.delete(route('payment-methods.destroy', method.external_method_id), {
        preserveScroll: true,
    });
};

const downloadInvoice = (externalInvoiceObj) => {
    window.open(route('billing.download-invoice', externalInvoiceObj.id), '_blank');
};


const formattedDatetime = (timestamp) => {
    return moment.unix(timestamp).format('YYYY-MM-DD hh:mm a');
}

// Set as Default Payment Method
const setAsDefault = () => {

    if (selectedMethod.value) {
        form.put(route('payment-methods.set-default', selectedMethod.value), {
            preserveScroll: true,
            onSuccess: ({ props }) => {
                props.defaultPaymentMethod = selectedMethod.value;
                selectedMethod.value = null;
            }
        });
    }
};


// Computed Payment Methods List
const userPaymentMethodList = computed(() => {
    return props.userPaymentMethods.length > 0
        ? props.userPaymentMethods.map(method => ({
            ...method,
            ...((props.allPaymentMethods?.data || []).find(({ slug }) => slug === method.card.display_brand) || {}),
            is_default: props.defaultPaymentMethod && props.defaultPaymentMethod.id === method.id,
            external_method_id: method.id,
        }))
        : [];
});
</script>

<template>
    <Head title="Billing" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Billing
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <h3 class="text-lg font-medium text-gray-900">Your Payment Methods</h3>
                    <div v-if="userPaymentMethodList.length" class="mt-4 space-y-4">
                        <div
                            v-for="method in userPaymentMethodList"
                            :key="method.id"
                            class="p-4 border rounded-lg flex items-center justify-between cursor-pointer hover:bg-blue-50"
                            :class="{
                                'border-red-500 border-2': selectedMethod && selectedMethod.id === method.id && !method.is_default,
                                'border-green-500': method.is_default
                            }"
                            @click="method.is_default ? null : selectedMethod = method"
                        >
                            <div class="flex items-center gap-4">
                                <img :src="method.attachment.full_url" alt="Visa Logo" class="w-12 h-12" v-if="method.attachment">
                                <div>
                                    <p class="text-blue-800 text-base font-medium">
                                        ending in <span class="font-semibold">{{ method.card.last4 }}</span>
                                    </p>
                                    <p class="text-gray-700 text-sm">Exp: {{ method.card.exp_month }}/{{ method.card.exp_year }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span v-if="method.is_default" class="bg-green-500 text-white text-xs px-2 py-1 rounded">Default</span>
                                <button type="button" class="rounded-full bg-red-600 p-1.5 text-white shadow-sm hover:bg-red-500 hover:cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                                @click.stop="deletePaymentMethod(method)"
                                >
                                    <XMarkIcon class="h-4 w-4" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-sm text-gray-500 mt-4">No payment methods added yet.</p>

                    <!-- Set as Default Button -->
                    <div v-if="selectedMethod && !selectedMethod.is_default" class="mt-4">
                        <button
                            @click="setAsDefault"
                            class="mt-6 bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-bold text-xl hover:bg-yellow-400 w-full"
                        >
                            Set as Default
                        </button>
                    </div>
                </div>

                <!-- Add Payment Method using Stripe.js -->
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <h3 class="text-lg font-medium text-gray-900">Add Payment Method</h3>
                    <form @submit.prevent="addPaymentMethod" class="mt-4">
                        <div id="card-element" class="border p-2 rounded w-full"></div>
                        <button
                            type="submit"
                            class="mt-10 bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-bold text-xl hover:bg-yellow-400 w-full"
                            :disabled="processing"
                        >
                            {{ processing ? 'Processing...' : 'Add Payment Method' }}
                        </button>
                    </form>
                </div>

                <!-- Invoice History Section -->
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <h3 class="text-lg font-medium text-gray-900">Billing History</h3>

                    <div class="-mx-4 mt-6 sm:-mx-0">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Invoice #
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Download</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="invoices.length" class="divide-y divide-gray-200 bg-white">
                                <tr v-for="invoice in invoices" :key="invoice.id">
                                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ invoice.number }}
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ formattedDatetime(invoice.created) }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-600 text-center">
                                        S$ {{ (invoice.amount_paid/ (Math.pow(10, 2))).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) }}
                                    </td>
                                    <td class="px-3 py-4 text-sm">

                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium w-fit"
                                        :class="{
                                                'bg-green-100 text-green-700': invoice.status === 'paid',
                                                'bg-yellow-100 text-yellow-700': invoice.status != 'paid',
                                        }">
                                            {{ invoice.status }}
                                        </span>
                                    </td>
                                    <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <button type="button" class="rounded-full bg-indigo-600 p-1.5 text-white shadow-sm hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        @click.prevent="downloadInvoice(invoice)"
                                        >
                                            <ArrowDownTrayIcon class="h-4 w-4" aria-hidden="true" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-sm text-gray-500">
                                        No invoices found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
