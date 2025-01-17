<template>
    <GuestLayout>
        <Head title="Register" />

        <section class="flex my-2 md:w-4/6 mx-auto pt-5 ">
            <h2 class="text-3xl font-semibold text-red-600 mx-auto">
                Sign Up
            </h2>
        </section>


        <section class="text-white rounded my-2 md:w-4/6 mx-auto py-5">
            <img src="/images/icon.png" alt="Vion Icon" class="w-1/3 lg:w-1/6 rounded mx-auto" />
        </section>

        <form @submit.prevent="submit" class="space-y-4 lg:w-3/12 mx-auto mb-10 px-2">
            <div v-show="!isShowOtpDiv">
                <div>
                    <div class="flex space-x-1">
                        <InputLabel for="name" value="Name" />
                        <span class="text-red-600">*</span>
                    </div>
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
                        autocomplete="off"
                        :disabled="!isFilledFieldEditable"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <div class="flex space-x-1">
                        <InputLabel for="email" value="Email" />
                        <span class="text-red-600">*</span>
                    </div>

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
                    <div class="flex space-x-1">
                        <InputLabel for="country_id" value="Country Code" />
                        <span class="text-red-600">*</span>
                    </div>

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
                    <div class="flex space-x-1">
                        <InputLabel for="phone_number" value="Phone Number" />
                        <span class="text-red-600">*</span>
                    </div>

                    <TextInput
                        id="phone_number"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{
                            'bg-gray-100': !isFilledFieldEditable,
                            'cursor-not-allowed': !isFilledFieldEditable
                        }"
                        @input="clearError('phone_number')"
                        v-model="form.phone_number"
                        :disabled="!isFilledFieldEditable"
                        required
                        placeholder="Enter your phone number"
                    />
                    <InputError class="mt-2" :message="form.errors.phone_number" />
                </div>

                <!-- Password (6-digit PIN) -->
                <div class="mt-4">
                    <div class="flex space-x-1 items-center">
                        <label for="password" class="flex items-center space-x-2">
                            <span>Password</span>
                            <span class="text-yellow-700 text-sm">(Choose your 6 digits PIN)</span>
                        </label>
                        <span class="text-red-600">*</span>
                    </div>
                    <div class="relative">
                        <TextInput
                            id="password"
                            :type="isPasswordVisible ? 'text' : 'password'"
                            class="mt-1 w-full pr-10"
                            :class="{
                                'bg-gray-100': !isFilledFieldEditable,
                                'cursor-not-allowed': !isFilledFieldEditable
                            }"
                            v-model="form.password"
                            :disabled="!isFilledFieldEditable"
                            placeholder="Numbers Only"
                        />
                        <button
                            type="button"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500"
                            @click="togglePasswordVisibility"
                        >
                            <span v-if="isPasswordVisible">
                                <img src="/images/components/eye_close.png" alt="hide password" class="w-8 h-8">
                            </span>
                            <span v-else>
                                <img src="/images/components/eye_open.png" alt="show password" class="w-8 h-8">
                            </span>
                        </button>
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>


                <div class="mt-2 flex items-center justify-center">
                    <div class="flex flex-col w-fit justify-self-center mt-10 gap-2 md:w-3/5 text-center">
                        <button
                            @click.prevent="verifyPhoneNumber"
                            class="bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400"
                            :class="{
                                'opacity-25': !isFormValid,
                                'cursor-not-allowed': !isFormValid
                            }"
                            :disabled="!isFormValid"
                        >
                            NEXT
                        </button>
                    </div>
                </div>
            </div>

            <!-- OTP Input -->
            <div class="flex justify-center">
                <div class="mt-1" v-if="isShowOtpDiv">
                    <label for="otpParts" class="flex flex-col space-y-1 items-center mb-3">
                        <span class="font-normal">
                            Enter 5-digits OTP sent to {{ countryOptions.find((country) => country.id == form.country_id).phone_code }}{{ form.phone_number }}
                        </span>
                        <span class="font-light">
                            (Expiring in 2 minutes<span v-if="nowAddTwoMinutes">, </span>{{ nowAddTwoMinutes }})
                        </span>
                    </label>
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
                            autocomplete="one-time-code"
                            type="text"
                            pattern="[0-9]*"
                            required
                            ref="otpInputs"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.otp" />
                </div>
            </div>

            <div class="flex justify-between items-center mt-2 px-5 space-x-3">
                <div class="underline text-gray-600 hover:cursor-pointer" @click.prevent="onBackButtonClicked()" v-if="isShowOtpDiv">
                    Back
                </div>
                <div>
                    <div class="flex items-center justify-end">
                        <PrimaryButton
                            @click.prevent="verifyPhoneNumber"
                            class="ms-2"
                            :class="{
                                'opacity-25': !form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || isCountdownActive || !isPasswordValid || isVerifying,
                                'cursor-not-allowed': !form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || isCountdownActive || !isPasswordValid || isVerifying
                            }"
                            :disabled="!form.name || !form.email || !form.dob || !form.country_id || !form.phone_number || isCountdownActive || !isPasswordValid || isVerifying"
                            v-if="isShowOtpDiv && !isCountdownActive"
                        >
                            <span v-if="isOtpRequested">
                                Resend OTP
                            </span>
                            <span v-else>
                                OTP to Verify Phone Number
                            </span>
                        </PrimaryButton>
                    </div>
                    <div v-if="isShowOtpDiv && isCountdownActive" class="flex justify-end mt-1 text-sm text-blue-500">
                        Resend SMS OTP in {{ countdown }} seconds...
                    </div>
                </div>
            </div>

            <div class="mt-2 px-4 items-center justify-center">
                <div class="flex flex-col w-fit justify-self-center mt-10 gap-2 md:w-3/5 text-center">
                    <button
                        @click.prevent="submit"
                        type="submit"
                        class="bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400"
                        :class="{
                            'opacity-25': !isOtpPartsFullyFilled,
                            'cursor-not-allowed': !isOtpPartsFullyFilled
                        }"
                        :disabled="!isOtpPartsFullyFilled"
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

<script setup>
import DatePicker from '@/Components/DatePicker.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, defineProps, onMounted, onUnmounted, ref, watch } from 'vue';
import moment from 'moment';

const countryOptions = ref([]);
const countdown = ref(60); // Countdown timer for OTP resend
const isCountdownActive = ref(false); // Track whether the countdown is active
const nowAddTwoMinutes = ref(null);

const form = useForm({
    country_id: '',
    dob: '',
    name: '',
    email: '',
    otpParts: ['', '', '', '', ''],
    password: '',
    phone_number: '',
    ref_id: '',
});

const isFormValid = computed(() => {
    return (
        form.name &&
        form.email &&
        form.dob &&
        form.country_id &&
        form.phone_number &&
        isPasswordValid.value &&
        !form.errors.phone_number // Ensures no phone number error exists
    );
});

const isFilledFieldEditable = ref(true);
const isOtpRequested = ref(false);
const isPasswordVisible = ref(false);
const isShowOtpDiv = ref(false);
const isVerifying = ref(false);

const props = defineProps({
    countryOptions: Object,
    refID: String,
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

// Computed property to check if all OTP fields are fully filled
const isOtpPartsFullyFilled = ref(false);
watch(
    () => form.otpParts,
    (otpParts) => {
        isOtpPartsFullyFilled.value = otpParts.every((part) => part.length === 1);
    },
    { immediate: true, deep: true }
);

// Computed property to check if password is valid (6 digits)
const isPasswordValid = ref(false);
watch(
    () => form.password,
    (password) => {
        isPasswordValid.value = /^[0-9]{6}$/.test(password);
    },
    { immediate: true }
);

function clearError(field) {
    form.errors[field] = '';
    countdownInterval = null; // Reset the interval ID
    isCountdownActive.value = false;
    nowAddTwoMinutes.value = null
    isVerifying.value = false
}

function onBackButtonClicked() {
    isShowOtpDiv.value = false;
    isFilledFieldEditable.value = true;
    isOtpRequested.value = false;
}

function togglePasswordVisibility() {
    isPasswordVisible.value = !isPasswordVisible.value;
}

let countdownInterval = null;

function verifyPhoneNumber() {
    if (isVerifying.value) return;

    isVerifying.value = true;

    form.post(route('verification.phone-number'), {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        onSuccess: (page) => {
            isShowOtpDiv.value = true;
            isFilledFieldEditable.value = false;
            isOtpRequested.value = true;

            countdown.value = 60;
            isCountdownActive.value = true;
            nowAddTwoMinutes.value = moment().add(2, 'minutes').format('hh:mm:ss a');
        },
    });

    // Clear existing interval before starting a new one
    if (countdownInterval) {
        clearInterval(countdownInterval);
    }

    // Start the countdown timer
    countdownInterval = setInterval(() => {
        if (countdown.value > 0) {
            countdown.value--;
        } else {
            clearInterval(countdownInterval); // Clear the interval
            countdownInterval = null; // Reset the interval ID
            isCountdownActive.value = false;
            nowAddTwoMinutes.value = null
            isVerifying.value = false
        }
    }, 1000);
}

onMounted(() => {
    countryOptions.value = props.countryOptions.data;

    // Set the default country code
    form.country_id = countryOptions.value.filter((country) => country.is_default)[0].id;
    form.ref_id = props.refID;
});

onUnmounted(() => {
    if (countdownInterval) {
        clearInterval(countdownInterval);
    }
});

const submit = () => {
    console.log(form.value.otpParts)
    form.post(route('register'));
};
</script>
