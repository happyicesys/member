<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DatePicker from '@/Components/DatePicker.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SuccessButton from '@/Components/SuccessButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref, watch } from 'vue';

const countryOptions = ref([]);
const countdown = ref(60); // Countdown timer for OTP resend
const isCountdownActive = ref(false); // Track whether the countdown is active

const form = useForm({
    country_id: '',
    dob: '',
    name: '',
    email: '',
    otp: '',
    passwordParts: ['', '', '', '', '', ''],
    phone_number: '',
});

const isShowOtpDiv = ref(false);
const isFilledFieldEditable = ref(true);
const isOtpRequested = ref(false);

const props = defineProps({
    countryOptions: Object,
});

// Handle input and jump to the next or previous input field
const onInput = (index) => {
    if (form.passwordParts[index].length === 1 && index < form.passwordParts.length - 1) {
        // Move focus to the next input
        const nextInput = document.getElementById(`password_${index + 1}`);
        if (nextInput) {
            nextInput.focus();
        }
    } else if (form.passwordParts[index].length === 0 && index > 0) {
        // Move focus to the previous input when deleting
        const prevInput = document.getElementById(`password_${index - 1}`);
        if (prevInput) {
            prevInput.focus();
        }
    }
};

function verifyPhoneNumber() {
    form.post(route('verification.phone-number'), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onSuccess: (page) => {
            isShowOtpDiv.value = true;
            isFilledFieldEditable.value = false;
            isOtpRequested.value = true;

            isCountdownActive.value = true;
            countdown.value = 60;
        },
    });

    // Start the countdown timer
    const countdownInterval = setInterval(() => {
        if (countdown.value > 0) {
            countdown.value--;
        } else {
            clearInterval(countdownInterval);
            isCountdownActive.value = false;
        }
    }, 1000);
}

onMounted(() => {
    countryOptions.value = props.countryOptions.data;

    // Set the default country code
    form.country_id = countryOptions.value.filter((country) => country.is_default)[0].id;
});

const submit = () => {
    form.post(route('register'));
};
</script>

<template>
    <GuestLayout>
        <ApplicationLogo class="mx-auto w-32"/>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    :class="{
                        'bg-gray-100': !isFilledFieldEditable,
                        'cursor-not-allowed': !isFilledFieldEditable
                    }"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    :disabled="!isFilledFieldEditable"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    :class="{
                        'bg-gray-100': !isFilledFieldEditable,
                        'cursor-not-allowed': !isFilledFieldEditable
                    }"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    :disabled="!isFilledFieldEditable"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <DatePicker
                    v-model="form.dob"
                    :disabled="!isFilledFieldEditable"
                    isPreviousNextButton="false"
                >
                    Birth Date
                </DatePicker>

                <InputError class="mt-2" :message="form.errors.dob" />
            </div>

            <!-- Country Code -->
            <div class="mt-4">
                <InputLabel for="country_id" value="Country Code" />

                <select
                    id="country_id"
                    class="mt-1 block w-full select2"
                    :class="{
                        'bg-gray-100': !isFilledFieldEditable,
                        'cursor-not-allowed': !isFilledFieldEditable
                    }"
                    v-model="form.country_id"
                    :disabled="!isFilledFieldEditable"
                    required
                >
                    <option value="" disabled>Select Country</option>
                    <option
                        v-for="country in countryOptions"
                        :key="country.id"
                        :value="country.id"
                    >
                        {{ country.phone_code }} ({{ country.name }})
                    </option>
                </select>
                <InputError class="mt-2" :message="form.errors.country_id" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <InputLabel for="phone_number" value="Phone Number" />

                <TextInput
                    id="phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    :class="{
                        'bg-gray-100': !isFilledFieldEditable,
                        'cursor-not-allowed': !isFilledFieldEditable
                    }"
                    v-model="form.phone_number"
                    :disabled="!isFilledFieldEditable"
                    required
                    placeholder="Enter your phone number"
                />
                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <!-- Password (6-digit PIN) -->
            <div class="mt-4">
                <InputLabel for="password" value="Create Your Own 6-digits PIN" />
                <div class="mt-2 grid grid-cols-6 gap-2">
                    <TextInput
                        v-for="(part, index) in form.passwordParts"
                        :key="index"
                        :id="'password_' + index"
                        class="block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        maxlength="1"
                        :class="{
                            'bg-gray-100': !isFilledFieldEditable,
                            'cursor-not-allowed': !isFilledFieldEditable
                        }"
                        v-model="form.passwordParts[index]"
                        :disabled="!isFilledFieldEditable"
                        @input="onInput(index)"
                        inputmode="numeric"
                        type="text"
                        pattern="[0-9]*"
                        required
                        ref="passwordInputs"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.passwordParts" />
            </div>

            <div v-if="isShowOtpDiv">
                <hr class="mt-4">
                <!-- OTP Input -->
                <div class="mt-4">
                    <InputLabel for="otp" value="OTP" />

                    <TextInput
                        id="otp"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.otp"
                        placeholder="5 digits from your SMS"
                    />
                    <InputError class="mt-2" :message="form.errors.otp" />
                </div>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    @click.prevent="verifyPhoneNumber"
                    class="ms-2"
                    :class="{
                        'opacity-25': !form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || form.passwordParts.some(part => part === '') || isCountdownActive,
                        'cursor-not-allowed': !form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || form.passwordParts.some(part => part === '') || isCountdownActive
                    }"
                    :disabled="!form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || form.passwordParts.some(part => part === '') || isCountdownActive"
                >
                    Verify Your Phone Number
                </PrimaryButton>
            </div>
            <div v-if="isCountdownActive" class="flex justify-end mt-1 text-sm text-blue-500">
                Resend SMS in {{ countdown }} seconds...
            </div>

            <div class="mt-4 flex items-center text-center">
                <SuccessButton
                    @click="submit"
                    class="w-full"
                    :class="{
                        'opacity-25': !form.otp,
                        'cursor-not-allowed': !form.otp
                    }"
                    :disabled="!form.otp"
                    v-if="isShowOtpDiv"
                >
                    Sign Up
                </SuccessButton>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already Sign Up?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
