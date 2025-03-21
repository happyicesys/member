<script setup>
import { ref, computed, onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';

const isContactDropdownOpen = ref(false)
const isPlanExpiring = usePage().props.auth.isPlanExpiringNotification
const plan = usePage().props.auth.plan.data
const planItemUser = usePage().props.auth.planItemUser.data
const user = usePage().props.auth.user;
const isMenuOpen = ref(false);
const showPromptUserRenewPlanBanner = ref(false);
const showFirstTimerBanner = ref(true);

const dismissFirstTimerBanner = () => {
    showFirstTimerBanner.value = false;
};

let contactDropdownTimeout = null;

function openContactDropdown() {
    if (contactDropdownTimeout) clearTimeout(contactDropdownTimeout);
    isContactDropdownOpen.value = true;
}

function closeContactDropdown() {
    contactDropdownTimeout = setTimeout(() => {
        isContactDropdownOpen.value = false;
    }, 200); // Adjust delay if needed
}

onMounted(() => {
    if(isPlanExpiring) {
        showPromptUserRenewPlanBanner.value = true;
    }
    if(user.login_count >= 2) {
        showFirstTimerBanner.value = false;
    }
})

function dismissPromptUserRenewPlanBanner() {
    showPromptUserRenewPlanBanner.value = false;
}

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}
</script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-100">
        <!-- Navigation Bar -->
        <nav class="border-b border-gray-100 bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo class="max-w-16 max-h-10" />
                        </Link>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <div class="hidden sm:flex space-x-8 items-center">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')" v-if="!$page.props.auth.user.is_admin">
                            Dashboard
                        </NavLink>
                        <NavLink :href="route('dashboard.admin')" :active="route().current('dashboard.admin')" v-if="$page.props.auth.user.is_admin">
                            Dashboard
                        </NavLink>
                        <NavLink :href="route('about')" :active="route().current('about')">
                            About Us
                        </NavLink>
                        <!-- <NavLink :href="route('contact-us')" :active="route().current('contact-us')">
                            Contact Us
                        </NavLink> -->
                        <div
                            class="relative"
                            @mouseenter="openContactDropdown"
                            @mouseleave="closeContactDropdown"
                        >
                            <button
                                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none"
                            >
                                Contact Us
                                <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l5 5 5-5" />
                                </svg>
                            </button>

                            <div
                                v-show="isContactDropdownOpen"
                                class="absolute left-0 mt-2 w-52 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                            >
                                <Link
                                    :href="route('contact-us')"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'font-semibold text-red-600': route().current('contact-us') }"
                                >
                                    Reach Us
                                </Link>
                                <Link
                                    :href="route('refund')"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    :class="{ 'font-semibold text-red-600': route().current('refund') }"
                                >
                                    Refund
                                </Link>
                            </div>
                        </div>

                        <NavLink :href="route('join-licensee')" :active="route().current('join-licensee')">
                            Join Us as Licensee
                        </NavLink>
                    </div>

                    <!-- Right Side (Settings and Hamburger) -->
                    <div class="flex items-center">
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                                            {{ $page.props.auth.user.name }}
                                            ({{ $page.props.auth.plan.data.name }})
                                            <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                    <DropdownLink :href="route('billing')">Billing</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                                </template>
                            </Dropdown>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex sm:hidden">
                            <button @click="toggleMenu" class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ hidden: isMenuOpen, 'inline-flex': !isMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ hidden: !isMenuOpen, 'inline-flex': isMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Menu -->
            <div :class="{ block: isMenuOpen, hidden: !isMenuOpen }" class="sm:hidden">
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('about')" :active="route().current('about')">About Us</ResponsiveNavLink>
                    <!-- <ResponsiveNavLink :href="route('contact-us')" :active="route().current('contact-us')">Contact
                        Us</ResponsiveNavLink> -->
                        <ResponsiveNavLink :href="route('contact-us')" :active="route().current('contact-us')">
                            Contact Us
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('refund')" :active="route().current('refund')">
                            Refund
                        </ResponsiveNavLink>

                    <ResponsiveNavLink :href="route('join-licensee')" :active="route().current('join-licensee')">Join Us as Licensee</ResponsiveNavLink>
                </div>
                <div class="border-t border-gray-200 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">{{ $page.props.auth.user.name }}</div>
                        <div class="text-sm font-medium text-gray-500">({{ $page.props.auth.plan.data.name }})</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')" :active="route().current('profile.edit')">Profile</ResponsiveNavLink>
                    </div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('billing')" :active="route().current('billing')">Billing</ResponsiveNavLink>
                    </div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div v-if="showFirstTimerBanner" class="bg-yellow-100 border-l-4 border-yellow-500 p-4 m-1 rounded-lg relative">
                <p class="text-yellow-700">
                    Thanks for signing up for DCVend! Now you can use your <strong>phone number</strong> and the <strong>6-digit passcode</strong> to <strong>log in on the vending machine</strong> and enjoy the best deals ever.
                </p>
                <button
                    @click="dismissFirstTimerBanner"
                    class="absolute top-1/2 right-4 transform -translate-y-1/2 text-yellow-700 hover:text-yellow-900 focus:outline-none"
                >
                    <span class="sr-only">Dismiss</span>
                    &times;
                </button>
            </div>
            <div v-if="showPromptUserRenewPlanBanner" class="bg-yellow-100 border-l-4 border-yellow-500 p-4 m-1 rounded-lg relative">
                <p class="text-yellow-700">
                    Your <strong>{{ plan.name }}</strong> plan is expiring on <strong>{{ planItemUser.date_to }}</strong>. Please
                    <a href="/plan" target="_blank" class="text-blue-600 underline">renew your plan</a>
                    to continue enjoying the best deals ever.
                </p>
                <button
                    @click="dismissPromptUserRenewPlanBanner"
                    class="absolute top-1/2 right-4 transform -translate-y-1/2 text-yellow-700 hover:text-yellow-900 focus:outline-none"
                >
                    <span class="sr-only">Dismiss</span>
                    &times;
                </button>
            </div>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="text-center pt-5 pb-10 bg-gray-50">
            <section class="flex flex-col items-center py-8">
                <div class="text-center text-gray-600 text-2xl font-semibold tracking-wide">Follow Us</div>
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

            <p class="text-sm text-gray-500">&copy; 2024 DCVIC PTE. LTD. All rights reserved.</p>
            <div class="flex justify-center space-x-5">
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
