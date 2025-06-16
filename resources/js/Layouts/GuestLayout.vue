<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);

// Get the current route name safely
const page = usePage();
const currentRoute = computed(() => page.props.value?.route?.name || '');
const isAuthenticated = usePage().props.auth.user !== null;
const isContactDropdownOpen = ref(false);
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
                                currentRoute == 'home' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Home
                        </Link>
                        <Link
                            :href="route('about')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute == 'about' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            About Us
                        </Link>
                        <!-- <Link
                            :href="route('contact-us')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute == 'contact-us' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Contact Us
                        </Link> -->
                        <!-- Contact Us Dropdown -->
                        <div
                            class="relative"
                            @mouseenter="isContactDropdownOpen = true"
                            @mouseleave="isContactDropdownOpen = false"
                        >
                            <div>
                                <button
                                    class="text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2 focus:outline-none"
                                >
                                    Contact Us
                                </button>
                            </div>
                            <transition name="fade">
                                <div
                                    v-show="isContactDropdownOpen"
                                    class="absolute z-50 mt-2 w-48 bg-white border border-gray-200 shadow-md rounded-md"
                                >
                                    <Link
                                        :href="route('contact-us')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'font-semibold text-red-600': currentRoute === 'contact-us' }"
                                    >
                                        Reach Us
                                    </Link>
                                    <Link
                                        :href="route('refund')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        :class="{ 'font-semibold text-red-600': currentRoute === 'refund' }"
                                    >
                                        Refund
                                    </Link>
                                </div>
                            </transition>
                        </div>


                        <Link
                            :href="route('join-licensee')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute == 'join-licensee' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Join Us as Licensee
                        </Link>
                        <Link
                            :href="route('register', { refID: 'web' })"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute == 'register' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Sign Up
                        </Link>
                        <Link
                            :href="route('forget')"
                            :class="[
                                'text-lg text-gray-600 hover:text-gray-800 hover:underline hover:underline-offset-[4pt] hover:decoration-red-600 hover:decoration-2',
                                currentRoute == 'forget' ? 'underline decoration-red-600 decoration-2' : ''
                            ]"
                        >
                            Reset Password
                        </Link>
                    </div>
                </nav>
                <div v-if="!isAuthenticated">
                    <Link :href="route('login')">
                        <img src="/images/components/login_button_1.png" class="h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg" alt="">
                    </Link>
                </div>
                <div v-else>
                    <Link :href="route('dashboard')">
                        <img src="/images/components/hi_member_button_1.png" class="h-10 lg:h-14 drop-shadow-md hover:drop-shadow-lg" alt="">
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
                        About Us
                    </ResponsiveNavLink>
                    <!-- <ResponsiveNavLink
                        :href="route('contact-us')"
                        :active="route().current('contact-us')"
                    >
                        Contact Us
                    </ResponsiveNavLink> -->
                    <ResponsiveNavLink
                        :href="route('contact-us')"
                        :active="route().current('contact-us')"
                    >
                        Contact Us
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('refund')"
                        :active="route().current('refund')"
                    >
                        Refund
                    </ResponsiveNavLink>

                    <ResponsiveNavLink
                        :href="route('join-licensee')"
                        :active="route().current('join-licensee')"
                    >
                        Join Us as Licensee
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('register', { refID: 'web' })"
                        :active="route().current('register')"
                    >
                        Sign Up
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('forget')"
                        :active="route().current('forget')"
                    >
                        Reset Password
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
            <p class="text-sm text-gray-500">
                &copy; 2024 DCVIC PTE. LTD. All rights reserved.
            </p>
            <div class="flex justify-center space-x-5 pt-3">
                <Link href="/terms-and-conditions" class="text-sm text-gray-500 hover:text-blue-600">Terms and Conditions</Link>
                <Link href="/privacy-policy" class="text-sm text-gray-500 hover:text-blue-600">Privacy Policy</Link>
            </div>
        </footer>
    </div>
</template>

<style scoped>
header {
    font-family: 'Poppins', sans-serif;
}
</style>
