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
    otpParts: ['', '', '', '', ''],
    password: '',
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
    if (form.otpParts[index].length === 1 && index < form.otpParts.length - 1) {
        // Move focus to the next input
        const nextInput = document.getElementById(`otp_${index + 1}`);
        if (nextInput) {
            nextInput.focus();
        }
    } else if (form.otpParts[index].length === 0 && index > 0) {
        // Move focus to the previous input when deleting
        const prevInput = document.getElementById(`otp_${index - 1}`);
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
        <Head title="Register" />

        <section class="text-white rounded my-2 md:w-4/6 mx-auto py-5">
            <img src="/images/icon.png" alt="Vion Icon" class="w-1/3 lg:w-1/6 rounded mx-auto" />
        </section>

        <form @submit.prevent="submit" class="space-y-4 lg:w-3/12 mx-auto mb-10 px-2">
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
                    class="mt-1 block w-full select2 rounded text-gray-600"
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

            <hr class="mt-4" v-if="isShowOtpDiv">
            <!-- OTP Input -->
            <div class="mt-4" v-if="isShowOtpDiv">
                <InputLabel for="otp" value="OTP" />
                <div class="flex space-x-1">
                    <TextInput
                        v-for="(part, index) in form.otpParts"
                        :key="index"
                        :id="'otp_' + index"
                        class="block flex w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        maxlength="1"
                        v-model="form.otpParts[index]"
                        @input="onInput(index)"
                        inputmode="numeric"
                        type="text"
                        pattern="[0-9]*"
                        required
                        ref="otpInputs"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.otpParts" />
            </div>

            <!-- Password (6-digit PIN) -->
            <div class="mt-4" v-if="isShowOtpDiv">
                <InputLabel for="password" value="Password (6-digits PIN)" />
                <TextInput
                    id="password"
                    type="number"
                    class="mt-1 w-full"
                    v-model="form.password"
                    placeholder="Numbers Only"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>


            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    @click.prevent="verifyPhoneNumber"
                    class="ms-2"
                    :class="{
                        'opacity-25': !form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || isCountdownActive,
                        'cursor-not-allowed': !form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || isCountdownActive
                    }"
                    :disabled="!form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || isCountdownActive"
                >
                    <span v-if="isOtpRequested">
                        Resend OTP
                    </span>
                    <span v-else>
                        Verify Your Phone Number
                    </span>
                </PrimaryButton>
            </div>
            <div v-if="isCountdownActive" class="flex justify-end mt-1 text-sm text-blue-500">
                Resend SMS in {{ countdown }} seconds...
            </div>

            <div class="mt-2 items-center justify-center">
                <div class="flex flex-col w-fit justify-self-center mt-10 gap-2 md:w-3/5 text-center">
                    <button
                        @click="submit"
                        type="submit"
                        class="bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400"
                        :class="{
                            'opacity-25': !form.otpParts || !form.password,
                            'cursor-not-allowed': !form.otpParts || !form.password
                        }"
                        :disabled="!form.otpParts || !form.password"
                        v-if="isShowOtpDiv"
                    >
                        SIGN UP
                    </button>
                    <span class="text-sm">
                        As per register, you agree to our
                        <Link :href="route('terms-and-conditions')" class="text-blue-500 underline">Terms & Conditions</Link>
                        and
                        <Link :href="route('privacy-policy')" class="text-blue-500 underline">Privacy Policy</Link>.
                    </span>
                </div>
            </div>

            <div class="my-10 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-md text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already Sign Up?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
