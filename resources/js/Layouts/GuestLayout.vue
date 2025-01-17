<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);

// Safely handle undefined props
const page = usePage();
const currentRoute = computed(() => page.value?.props?.route?.name || '');

const isMenuOpen = ref(false);

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}
</script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-100">
        <header class="flex justify-between items-center px-4 py-4 bg-gray-50 shadow-md">
            <!-- Hamburger Menu -->
            <button
                class="lg:hidden focus:outline-none"
                @click="toggleMenu"
                aria-label="Toggle Menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <Link :href="route('home')">
                <img src="/images/logo_1.png" alt="DCVend Logo" class="h-12 md:h-20"/>
            </Link>
            <div class="flex items-center space-x-10">
                <nav class="hidden lg:block flex justify-between space-x-16 items-center text-sm">
                    <div class="flex gap-10">
                        <Link
                            :href="route('home')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute === 'home' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Home
                        </Link>
                        <Link
                            :href="route('about')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute === 'about' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            About
                        </Link>
                        <Link
                            :href="route('contact-us')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute === 'contact-us' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Contact Us
                        </Link>
                        <Link
                            :href="route('register')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute === 'register' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Sign Up
                        </Link>
                    </div>
                </nav>
                <div>
                    <Link :href="route('login')">
                        <img src="/images/components/login_button_1.png" class="h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg" alt="">
                    </Link>
                </div>
            </div>
        </header>

        <!-- Responsive Navigation Menu -->
        <nav class="border-b border-gray-100 bg-white">
            <div
                :class="{
                    block: isMenuOpen,
                    hidden: !isMenuOpen,
                }"
                class="sm:hidden"
            >
                <div class="items-center space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        :href="route('home')"
                        :active="route().current('home')"
                    >
                        Home
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('about')"
                        :active="route().current('about')"
                    >
                        About
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('contact-us')"
                        :active="route().current('contact-us')"
                    >
                        Contact Us
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('register')"
                        :active="route().current('register')"
                    >
                        Sign Up
                    </ResponsiveNavLink>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="text-center pt-5 pb-10 bg-gray-50">
            <!-- Mass Media Section -->
            <section class="flex flex-col items-center py-8">
                <div class="text-center text-gray-600 text-2xl font-semibold tracking-wide">
                    Follow Us
                </div>
                <div class="flex justify-between space-x-2 mt-4">
                    <a href="https://www.facebook.com/dcvendsg" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                            <path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"></path>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/dcvendsg/" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                            <path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z"></path>
                        </svg>
                    </a>
                    <a href="https://www.tiktok.com/@dcvendsg" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                            <path d="M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z M37.006,22.323 c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527 s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053 c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016 c0.378,3.591,3.277,6.425,6.901,6.685V22.323z"></path>
                        </svg>
                    </a>
                </div>
            </section>

            <p class="text-sm text-gray-500">
                &copy; 2024 DCVIC PTE. LTD. All rights reserved.
            </p>
            <div class="flex justify-center space-x-5">
                <Link
                    href="/terms-and-conditions"
                    class="text-sm text-gray-500 hover:text-blue-600"
                >
                    Terms and Conditions
                </Link>
                <Link
                    href="/privacy-policy"
                    class="text-sm text-gray-500 hover:text-blue-600"
                >
                    Privacy Policy
                </Link>
            </div>
        </footer>
    </div>
</template>

<style scoped>
header {
    font-family: 'Poppins', sans-serif;
}
</style>
