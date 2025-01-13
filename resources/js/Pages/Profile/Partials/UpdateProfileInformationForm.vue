<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    countryOptions: Object,
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const countryOptions = ref([])

const user = usePage().props.auth.user;

const form = useForm({
    country_id: user.country_id,
    name: user.name,
    email: user.email,
    phone_number: user.phone_number,
});

onMounted(() => {
    countryOptions.value = props.countryOptions.data;

    // Set the default country code
    form.country_id = countryOptions.value.find(
        (country) => country.id == user.phone_country_id
    )?.id;
});

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information, email address and phone number.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

                        <!-- Country Code -->
                        <div>
                <InputLabel for="country_id" value="Country Code" />

                <select
                    id="country_id"
                    class="mt-1 block w-full select2 bg-gray-100 cursor-not-allowed"
                    v-model="form.country_id"
                    disabled
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
                    class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                    v-model="form.phone_number"
                    disabled
                    required
                    placeholder="Enter your phone number"
                />
                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-2 gap-8 md:w-2/5 text-center">
                    <button type="submit" :disabled="form.processing" class="bg-yellow-300 py-1 px-6 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-bold text-xl hover:bg-yellow-400">
                        Save
                    </button>
                </div>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
