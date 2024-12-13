<template>
    <GuestLayout>
        <Head title="Log in" />

        <ApplicationLogo class="mx-auto mt-14 mb-14 w-32 h-auto" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <!-- Country Code -->
            <div>
                <InputLabel for="country_id" value="Country Code" />

                <select
                    id="country_id"
                    class="mt-1 block w-full select2"
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
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                    required
                    placeholder="Enter your phone number"
                />
                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <!-- Password (6-digit PIN) -->
            <div class="mt-4">
                <InputLabel for="password" value="Password (6-digit PIN)" />
                <div class="mt-2 grid grid-cols-6 gap-2">
                    <TextInput
                        v-for="(part, index) in form.passwordParts"
                        :key="index"
                        :id="'password_' + index"
                        class="block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        maxlength="1"
                        v-model="form.passwordParts[index]"
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

            <!-- Remember Me -->
            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <Link
                    :href="route('register')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Sign Up?
                </Link>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref } from 'vue';

// Props to manage password reset status and error message
const props = defineProps({
    countryOptions: Object,
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    country_id: '',
    phone_number: '',
    passwordParts: ['', '', '', '', '', ''],
    remember: false,
});

// To handle password input parts
const updatePassword = () => {
    form.password = form.passwordParts.join('');
};

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

// To submit the form to the server
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

// Fetch countries on mount
const countryOptions = ref([]);

onMounted(() => {
    countryOptions.value = props.countryOptions.data;

    // Set the default country code
    form.country_id = countryOptions.value.filter((country) => country.is_default)[0].id;
});
</script>
