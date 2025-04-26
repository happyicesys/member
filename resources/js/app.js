import '../css/app.css';
import './bootstrap';
import 'swiper/css'; // Core Swiper styles
import 'swiper/css/navigation'; // Optional: If using navigation buttons
import 'swiper/css/pagination'; // Optional: If using pagination

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Swiper from 'swiper/bundle';
import { VueReCaptcha,useReCaptcha } from 'vue-recaptcha-v3'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const captcheKey = props.initialPage.props.recaptcha_site_key;
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueReCaptcha, { siteKey: captcheKey,loaderOptions: {useRecaptchaNet: true}})
            .mount(el);
    },
    progress: {
        color: 'red',
        showSpinner: true,
    }
});
