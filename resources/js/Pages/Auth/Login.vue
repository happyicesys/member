<template>
    <GuestLayout>
        <Head title="Log in" />

        <section class="text-white rounded my-2 md:w-4/6 mx-auto py-5">
            <img src="/images/icon.png" alt="Vion Icon" class="w-1/3 lg:w-1/6 rounded mx-auto" />
        </section>

        <div v-if="status" class="mb-2 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4 lg:w-3/12 mx-auto mb-10 px-2">
            <!-- Country Code -->
            <div>
                <div class="flex space-x-1 items-center">
                    <label for="password" class="flex items-center space-x-2">
                        <InputLabel for="country_id" value="Country Code"/>
                    </label>
                    <span class="text-red-600">*</span>
                </div>

                <select
                    id="country_id"
                    class="mt-1 block w-full select2 rounded text-gray-600"
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
                <div class="flex space-x-1 items-center">
                    <label for="password" class="flex items-center space-x-2">
                        <InputLabel for="phone_number" value="Phone Number" />
                    </label>
                    <span class="text-red-600">*</span>
                </div>

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
            <!-- <div class="mt-4">
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
            </div> -->

            <!-- Password (6-digit PIN) -->
            <div class="mt-4">
                <div class="flex space-x-1 items-center">
                    <label for="password" class="flex items-center space-x-2">
                        <span>Password</span>
                        <span class="text-yellow-700 text-sm">(6 digits PIN)</span>
                    </label>
                    <span class="text-red-600">*</span>
                </div>
                <div class="relative">
                    <TextInput
                        id="password"
                        :type="isPasswordVisible ? 'text' : 'password'"
                        class="mt-1 w-full pr-10"
                        v-model="form.password"
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

            <!-- Remember Me -->
            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <Link
                    :href="route('register', { refID: 'web' })"
                    class="rounded-md text-lg text-red-600 underline hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Sign Up?
                </Link>

                <Link
                    v-if="canResetPassword"
                    :href="route('forgot')"
                    class="rounded-md text-lg text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <!-- <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton> -->
            </div>
            <div class="mt-2 flex items-center justify-center">
                <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-2 gap-8 md:w-2/5 text-center">
                    <button type="submit" class="bg-yellow-300 py-2 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400">
                        LOGIN
                    </button>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, onMounted, ref, watch } from 'vue';

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
    password: '',
    remember: false,
});

const isPasswordVisible = ref(false);

// To handle password input parts
// const updatePassword = () => {
//     form.password = form.passwordParts.join('');
// };

// // Handle input and jump to the next or previous input field
// const onInput = (index) => {
//     if (form.passwordParts[index].length === 1 && index < form.passwordParts.length - 1) {
//         // Move focus to the next input
//         const nextInput = document.getElementById(`password_${index + 1}`);
//         if (nextInput) {
//             nextInput.focus();
//         }
//     } else if (form.passwordParts[index].length === 0 && index > 0) {
//         // Move focus to the previous input when deleting
//         const prevInput = document.getElementById(`password_${index - 1}`);
//         if (prevInput) {
//             prevInput.focus();
//         }
//     }
// };

// To submit the form to the server
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

// Fetch countries on mount
const countryOptions = ref([]);

// Computed property to check if password is valid (6 digits)
const isPasswordValid = ref(false);
watch(
    () => form.password,
    (password) => {
        isPasswordValid.value = /^[0-9]{6}$/.test(password);
    },
    { immediate: true }
);

onMounted(() => {
    countryOptions.value = props.countryOptions.data;

    // Set the default country code
    form.country_id = countryOptions.value.filter((country) => country.is_default)[0].id;
});

function togglePasswordVisibility() {
    isPasswordVisible.value = !isPasswordVisible.value;
}

</script>
