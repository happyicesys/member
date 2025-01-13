<template>
    <GuestLayout>
        <Head title="Contact Us" />

        <!-- JotForm Embed -->
        <iframe
            id="JotFormIFrame-250061264637453"
            title="Reach out to DCVend"
            allowtransparency="true"
            allow="geolocation; microphone; camera; fullscreen"
            src="https://form.jotform.com/250061264637453"
            frameborder="0"
            style="min-width:100%;max-width:100%;height:539px;border:none;"
            scrolling="no"
        ></iframe>

        <section class="text-white rounded my-2  md:w-4/6 mx-auto py-6">
            <img src="/images/office_map_image.jpg" alt="DCVend Banner" class="w-full rounded" />
        </section>

        <div class="text-center mt-6 mb-10">
            <h1 class="text-red-600 text-3xl font-bold">Our Office</h1>
            <p class="text-gray-600 text-xl mt-4 font-bold">DCVIC Pte Ltd</p>
            <p class="text-gray-600 mt-2">
                Address: Blk 2021, #01-198, Bukit Batok St 23, 659526
            </p>
            <p class="text-gray-600 mt-2">
                Phone: 6563 1692
            </p>
            <p class="text-gray-600 mt-2">
                mail: enquiry@dcvend.com
            </p>
        </div>

    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';

onMounted(() => {
    // Load the JotForm Embed Handler script
    const script = document.createElement('script');
    script.src = 'https://cdn.jotfor.ms/s/umd/latest/for-form-embed-handler.js';
    script.async = true;
    script.onload = () => {
        // Initialize the JotForm embed handler
        if (window.jotformEmbedHandler) {
            window.jotformEmbedHandler(
                "iframe[id='JotFormIFrame-250061264637453']",
                'https://form.jotform.com/'
            );
        }
    };
    document.body.appendChild(script);
});
</script>
