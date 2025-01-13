<template>
    <GuestLayout>
        <Head title="DCVend Membership" />

        <!-- Hero Section -->
        <section class="text-white rounded my-2 px-2">
            <img src="/images/banner_2.jpg" alt="DCVend Banner" class="w-full rounded hidden md:block" />
            <img src="/images/banner_mobile_1.jpg" alt="DCVend Banner Mobile" class="w-full rounded md:hidden">
        </section>

        <!-- Stats Section -->
        <section class="bg-white py-8 px-4">
            <div class="text-center text-red-600 text-3xl font-semibold tracking-wide">
                <div class="md:w-1/2 mx-auto">
                    Enjoy premium ice cream at 30% discount with a DCVend membership
                </div>
            </div>
            <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-4 md:gap-8 md:w-2/5 text-center mx-auto">
                <div class="bg-yellow-300 py-6 px-10 rounded-lg shadow-md">
                    <p class="text-2xl font-bold text-red-600 flex items-center space-x-2">
                        <span class="text-3xl font-extrabold drop-shadow-sm">
                            {{stats['users'].toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}}
                        </span>
                        <span>
                            Members
                        </span>
                    </p>
                </div>
                <div class="bg-yellow-300 py-6 px-10 rounded-lg shadow-md">
                    <p class="text-2xl font-bold text-red-600 flex items-center space-x-2">
                        <span class="text-3xl font-extrabold drop-shadow-sm">
                            S$ {{ stats['discount'].toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) }}
                        </span>
                        <span>
                            Discount Given
                        </span>
                    </p>
                </div>
            </div>
        </section>

        <!-- Why Join Section -->
        <section class="pb-6 pt-5 md:pt-8 bg-white px-6">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">Why Join DCVend?</h2>
                <ul class="text-gray-600 space-y-1 text-left md:text-center">
                    <li>
                        <strong>Discount & Convenient:</strong> Enjoy 30% off premium ice cream, 24/7
                    </li>
                    <li>
                        <strong>Free membership:</strong> Start saving today! Upgrade to VIP for exclusive perks.
                    </li>
                    <li>
                        <strong>Exclusive Perks:</strong> Unlock special products and offers from our partners.
                    </li>
                    <li>
                        <strong>Instant Delivery:</strong> Order via Grab and get 8% cashback.
                    </li>
                    <li>
                        <strong>Daily Deals:</strong> Incredible savings on a rotating selection of flavours.
                    </li>
                </ul>
            </div>
        </section>

        <!-- Membership Plans -->
        <section class="py-6 md:py-12 bg-gray-50 rounded px-6">
            <div class="container mx-auto max-w-6xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-8">Membership Plans</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Free Member -->
                    <div class="bg-slate-200 rounded-md shadow-md p-6 text-center">
                        <h3 class="text-4xl font-bold text-red-600 font-extrabold mb-4">FREE Member</h3>
                        <ul class="text-gray-600 mb-4 space-y-2">
                            <li><strong>1 time: </strong> 30% discount on all products</li>
                        </ul>
                        <p class="text-xl font-bold text-gray-600">FREE/ month</p>
                    </div>

                    <!-- VIP Member -->
                    <div class="bg-slate-200 rounded-md shadow-md p-6 text-center">
                        <h3 class="text-4xl font-bold text-red-600 font-extrabold mb-4">Gold Member</h3>
                        <ul class="text-gray-600 mb-4 space-y-2">
                            <li><strong>4 times:</strong> 30% discount on all products</li>
                        </ul>
                        <p class="text-xl font-bold text-gray-600">S$ 2.90/ month</p>
                    </div>

                    <!-- SuperVIP Member -->
                    <div class="bg-slate-300 rounded-md shadow-md p-6 text-center">
                        <h3 class="text-4xl font-bold text-gray-500 font-extrabold mb-4">
                            Platinum Member
                            <small class="text-sm">(Coming soon)</small>
                        </h3>
                        <ul class="text-gray-500 mb-4 space-y-2">
                            <li><strong>Unlimited:</strong> 30% discount on all products</li>
                            <li><strong>FREE:</strong> 1x Magnum ice cream (worth: S$4.70)</li>
                            <li><strong>Unlimited:</strong> Daily Deals, daily basis</li>
                            <li><strong>Unlimited:</strong> 8% cashback on orders via Grab</li>
                            <li><strong>Unlimited:</strong> 8% discount from affiliated vending machines</li>

                        </ul>
                        <p class="text-xl font-bold text-gray-600">S$ 5.00/ month</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="bg-white py-8 px-6">
            <div class="text-center text-gray-600 text-2xl font-semibold tracking-wide md:w-3/5 mx-auto">
                Free 2 months VIP member package for new sign-up, with FREE upgrade to unlimited times of 30% discount on all products
            </div>
            <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-8 md:w-2/5 text-center mx-auto">
                <Link :href="route('register')" class="bg-yellow-300 py-4 px-8 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-xl hover:bg-yellow-400">
                    SIGN UP NOW
                </Link>
            </div>
        </section>

        <!-- Map Section -->
        <section class="pb-6 pt-4 md:pt-8 bg-white">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">DCVend Location</h2>
            </div>
            <div id="map" class="sm:col-span-6 mb-3 items-center mx-auto w-11/12 md:w-9/12 h-96"></div>
        </section>


    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { defineProps, onMounted } from 'vue';

const props = defineProps({
    dcVends: [Array, Object],
    mapApiKey: String,
    stats: [Array, Object],
});

let map;
let directionsService;

onMounted(() => {
    console.log('DCVend:', props.dcVends);
    loadGoogleMapsApi();
});

function loadGoogleMapsApi() {
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=${props.mapApiKey}&callback=initMap&libraries=places`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
}

window.initMap = function () {
    directionsService = new google.maps.DirectionsService();

    // Get user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Initialize the map with user's location
                map = new google.maps.Map(document.getElementById('map'), {
                    center: userLocation,
                    zoom: 12,
                });

                // Add markers to the map
                addMarkers();

                // Optionally, add a marker for the user's location
                new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    label: 'You',
                });
            },
            (error) => {
                console.error('Error getting user location:', error);

                // Fallback to default location if user denies access
                initializeMapWithDefaultLocation();
            }
        );
    } else {
        console.error('Geolocation is not supported by this browser.');

        // Fallback to default location
        initializeMapWithDefaultLocation();
    }
};

function initializeMapWithDefaultLocation() {
    const defaultPos = { lat: 3.139, lng: 101.6869 }; // Example: Kuala Lumpur

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultPos,
        zoom: 12,
    });

    addMarkers();
}

function addMarkers() {
    const markersData = [
        { lat: 3.139, lng: 101.6869, label: 'A' },
        { lat: 3.141, lng: 101.689, label: 'B' },
    ];

    markersData.forEach((data) => {
        new google.maps.Marker({
            position: { lat: data.lat, lng: data.lng },
            map: map,
            label: data.label,
        });
    });
}
</script>

<style scoped>
header {
    font-family: 'Poppins', sans-serif;
}
</style>
