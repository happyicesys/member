<template>
  <GuestLayout>
      <Head title="Join us as licensee" />

      <!-- JotForm Embed -->
      <iframe
        id="JotFormIFrame-250207518296458"
        title="DCVend Licensee Plan"
        onload="window.parent.scrollTo(0,0)"
        allowtransparency="true"
        allow="geolocation; microphone; camera; fullscreen"
        src="https://form.jotform.com/250207518296458"
        frameborder="0"
        style="min-width:100%;max-width:100%;height:539px;border:none;"
        scrolling="no"
      >
      </iframe>

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
              "iframe[id='JotFormIFrame-250207518296458']",
              'https://form.jotform.com/'
          );
      }
  };
  document.body.appendChild(script);
});
</script>
