<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    current_pin: ['', '', '', '', '', ''],
    new_pin: ['', '', '', '', '', ''],
    new_pin_confirmation: ['', '', '', '', '', ''],

});

const onInput = (index, field) => {
    if (form[field][index].length === 1 && index < form[field].length - 1) {
        const nextInput = document.getElementById(`${field}_${index + 1}`);
        if (nextInput) nextInput.focus();
    } else if (form[field][index].length === 0 && index > 0) {
        const prevInput = document.getElementById(`${field}_${index - 1}`);
        if (prevInput) prevInput.focus();
    }
};

const updatePin = () => {
    // Prepare the data to send
    const payload = {
        current_password: form.current_pin.join(''),
        password: form.new_pin.join(''),
        password_confirmation: form.new_pin_confirmation.join(''),
    };

    // Use form.post() to send the transformed payload
    form.post(route('pin.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('new_pin', 'new_pin_confirmation');
            }
            if (form.errors.current_password) {
                form.reset('current_pin');
            }
        },
    });
};



</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update PIN</h2>
            <p class="mt-1 text-sm text-gray-600">Update your secure 6-digit PIN to enhance account security.</p>
        </header>

        <form @submit.prevent="updatePin" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_pin" value="Current PIN" />

                <div class="mt-2 grid grid-cols-6 gap-2">
                    <TextInput
                        v-for="(part, index) in form.current_pin"
                        :key="`current_${index}`"
                        :id="`current_pin_${index}`"
                        class="block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        maxlength="1"
                        v-model="form.current_pin[index]"
                        @input="onInput(index, 'current_pin')"
                        inputmode="numeric"
                        type="text"
                        pattern="[0-9]*"
                        required
                    />
                </div>
                <InputError :message="form.errors.current_pin" class="mt-2" />
            </div>

            <div>
                <InputLabel for="new_pin" value="New PIN" class="text-red-600" />

                <div class="mt-2 grid grid-cols-6 gap-2">
                    <TextInput
                        v-for="(part, index) in form.new_pin"
                        :key="`new_${index}`"
                        :id="`new_pin_${index}`"
                        class="block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        maxlength="1"
                        v-model="form.new_pin[index]"
                        @input="onInput(index, 'new_pin')"
                        inputmode="numeric"
                        type="text"
                        pattern="[0-9]*"
                        required
                    />
                </div>
                <InputError :message="form.errors.new_pin" class="mt-2" />
            </div>

            <div>
                <InputLabel for="new_pin_confirmation" value="Confirm New PIN" class="text-red-600" />

                <div class="mt-2 grid grid-cols-6 gap-2">
                    <TextInput
                        v-for="(part, index) in form.new_pin_confirmation"
                        :key="`confirm_${index}`"
                        :id="`new_pin_confirmation_${index}`"
                        class="block w-14 text-center px-2 py-3 border rounded-md focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        maxlength="1"
                        v-model="form.new_pin_confirmation[index]"
                        @input="onInput(index, 'new_pin_confirmation')"
                        inputmode="numeric"
                        type="text"
                        pattern="[0-9]*"
                        required
                    />
                </div>
                <InputError :message="form.errors.new_pin_confirmation" class="mt-2" />
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
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
