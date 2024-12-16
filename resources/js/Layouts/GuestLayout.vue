<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-200 pt-6 sm:justify-center sm:pt-0"
    >
        <!-- <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div> -->

        <div
            class="mt-6 w-full overflow-visible bg-gray-50 px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />

                        <!-- Copyright Notice -->
            <div class="text-center pt-14 pb-4">
                <p class="text-sm text-gray-500">&copy; 2024 DCVIC PTE. LTD. All rights reserved.</p>
            </div>
        </div>
    </div>
</template>
