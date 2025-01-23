<template>
    <GuestLayout>
        <Head title="Reset PIN" />

        <section class="text-white rounded my-2 md:w-4/6 mx-auto py-5">
            <img src="/images/icon.png" alt="Vion Icon" class="w-1/3 lg:w-1/6 rounded mx-auto" />
        </section>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Reset Your PIN</h1>
            <p class="mt-2 text-gray-600">Enter your phone number to receive a one-time password (OTP) to reset your PIN.</p>
        </div>

        <form @submit.prevent="submit" class="space-y-4 lg:w-3/12 mx-auto mb-10 px-2">
            <!-- Country Code -->
            <div>
                <InputLabel for="country_id" value="Country Code" />

                <select
                    id="country_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    :class="{
                        'bg-gray-100': !isFilledFieldEditable,
                        'cursor-not-allowed': !isFilledFieldEditable
                    }"
                    :disabled="!isFilledFieldEditable"
                    v-model="form.country_id"
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
            <div>
                <InputLabel for="phone_number" value="Phone Number" />

                <TextInput
                    id="phone_number"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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

            <div v-if="isOtpRequested">
                <hr class="mt-6">
                <!-- OTP Input -->
                                <!-- New 6-digit PIN -->
                <div class="mt-6">
                    <label for="otpParts" class="flex flex-col space-y-1 items-center mb-3">
                        <span class="font-normal">
                            Enter 5-digits OTP sent to {{ countryOptions.find((country) => country.id == form.country_id).phone_code }}{{ form.phone_number }}
                        </span>
                        <span class="font-light">
                            (Expiring in 2 minutes<span v-if="nowAddTwoMinutes">, </span>{{ nowAddTwoMinutes }})
                        </span>
                    </label>
                    <div class="mt-2 grid grid-cols-6 gap-2">
                        <TextInput
                            v-for="(otp, index) in form.otpParts"
                            :key="index"
                            :id="'otp_' + index"
                            class="block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
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
                    <InputError class="mt-2" :message="form.errors.passwordParts" />
                </div>

                <div class="mt-6">
                    <label for="password" class="flex items-center space-x-2">
                            <span>Password</span>
                            <span class="text-yellow-700 text-sm">(Choose your 6 digits PIN)</span>
                    </label>
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
                            @input="onInputUpdate()"
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
            </div>

            <div class="mt-6 flex items-center justify-end">
                <PrimaryButton
                    @click.prevent="verifyPhoneNumber"
                    class="ms-2"
                    :class="{
                        'opacity-25': !form.country_id || !form.phone_number || isCountdownActive,
                        'cursor-not-allowed': !form.country_id || !form.phone_number || isCountdownActive
                    }"
                    :disabled="!form.country_id || !form.phone_number || isCountdownActive"
                    v-if="!isOtpRequested"
                >
                    Send OTP
                </PrimaryButton>
            </div>
            <div v-if="isCountdownActive" class="flex justify-end mt-2 text-sm text-blue-500">
                Resend SMS in {{ countdown }} seconds...
            </div>

            <div class="mt-2 flex items-center justify-center">
                <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-2 gap-8 md:w-2/5 text-center">
                    <button
                        @click="submit"
                        type="submit"
                        class="bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400"
                        :class="{
                            'opacity-25': !form.otp || form.passwordParts.some(part => part === ''),
                            'cursor-not-allowed': !form.otp || form.passwordParts.some(part => part === '')
                        }"
                        :disabled="!form.otp || form.passwordParts.some(part => part === '')"
                        v-if="isOtpRequested"
                    >
                        RESET PIN
                    </button>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Back to Login
                </Link>
            </div>
        </form>
    </GuestLayout>
  </template>


<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SuccessButton from '@/Components/SuccessButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
  countryOptions: Object,
});

const form = useForm({
  country_id: '',
  phone_number: '',
  otpParts: ['', '', '', '', ''],
  password: '',
});

const isOtpRequested = ref(false);
const countdown = ref(60); // Countdown timer for OTP resend
const isCountdownActive = ref(false);
const isFilledFieldEditable = ref(true);
const isPasswordVisible = ref(false);

const countryOptions = ref([]);

onMounted(() => {
  countryOptions.value = props.countryOptions.data;

  form.country_id = countryOptions.value.filter((country) => country.is_default)[0].id;
});

const verifyPhoneNumber = () => {
  form.post(route('forget.verification'), {
      preserveState: true,
      preserveScroll: true,
      replace: true,
      onSuccess: () => {
          isOtpRequested.value = true;
          isCountdownActive.value = true;
          isFilledFieldEditable.value = false;
          countdown.value = 60;

          // Start the countdown timer
          const countdownInterval = setInterval(() => {
              if (countdown.value > 0) {
                  countdown.value--;
              } else {
                  clearInterval(countdownInterval);
                  isCountdownActive.value = false;
              }
          }, 1000);
      },
  });
};

const onInput = (index) => {
  if (form.otpParts[index].length === 1 && index < form.otpParts.length - 1) {
      const nextInput = document.getElementById(`otp_${index + 1}`);
      if (nextInput) {
          nextInput.focus();
      }
  } else if (form.otpParts[index].length === 0 && index > 0) {
      const prevInput = document.getElementById(`otp_${index - 1}`);
      if (prevInput) {
          prevInput.focus();
      }
  }
};

const submit = () => {
  form.post(route('reset.pin'), {
      onFinish: () => form.reset('otpParts', 'password'),
  });
};

function togglePasswordVisibility() {
    isPasswordVisible.value = !isPasswordVisible.value;
}
</script>
