<template>
    <GuestLayout>
        <Head title="DCVend Membership" />

        <!-- Hero Section -->
        <section class="text-white rounded my-2 px-2">
            <img src="/images/banner_4.jpg" alt="DCVend Banner" class="w-full rounded hidden md:block" />
            <img src="/images/banner_mobile_4.jpg" alt="DCVend Banner Mobile" class="w-full rounded md:hidden">
        </section>

        <!-- Stats Section -->
        <section class="bg-white py-8 px-4">
            <div class="text-center text-red-600 text-3xl font-semibold tracking-wide">
                <div class="md:w-1/2 mx-auto">
                    Buy 1 ice cream also get 30% discount with a DCVend membership
                </div>
            </div>
            <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-4 md:gap-8 md:w-2/5 text-center mx-auto">
                <div class="bg-yellow-300 py-3 md:py-6 px-14 rounded-lg shadow-md">
                    <p class="text-xl md:text-2xl font-bold text-gray-600 flex flex-col items-center space-y-2">
                        <span class="text-3xl md:text-5xl font-extrabold drop-shadow-sm">
                            {{stats['users'].toLocaleString(undefined, {minimumFractionDigits: 0, maximumFractionDigits: 0})}}
                        </span>
                        <span>
                            Members
                        </span>
                    </p>
                </div>
                <div class="bg-yellow-300 py-3 md:py-6 px-10 rounded-lg shadow-md hidden">
                    <p class="text-xl md:text-2xl font-bold text-gray-600 flex flex-col  items-center space-y-2">
                        <span class="text-3xl md:text-5xl font-extrabold drop-shadow-sm">
                            S$ {{ stats['discount'].toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) }}
                        </span>
                        <span>
                            Discount Given
                        </span>
                    </p>
                </div>
            </div>
            <div class="text-right text-gray-600 text-md mt-2">
                <div class="md:w-1/5 mx-auto">
                    updated daily
                </div>
            </div>
        </section>

        <!-- Why Join Section -->
        <section class="pb-6 pt-2 md:pt-6 bg-white px-6">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">Why Join DCVend?</h2>
                <ul class="text-gray-600 space-y-1 text-left md:text-center">
                    <li>
                        <strong>Discount & Convenient:</strong> 24/7, 30% discount, even just buy 1 piece.
                    </li>
                    <li>
                        <strong>Free membership:</strong> Start saving today! Upgrade membership for more benefits.
                    </li>
                    <li>
                        <strong>Exclusive Perks:</strong> Unlock special products and offers from our partners.
                    </li>
                    <li>
                        <strong>Instant Delivery:</strong> Order via Grab and get 8% cashback.
                    </li>
                    <li>
                        <strong>Crazy After-Meal Deals:</strong> Incredible savings on a rotating selection of flavours.
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
                        <h3 class="text-4xl font-bold text-gray-600 font-extrabold mb-4">FREE Member</h3>
                        <ul class="text-gray-600 mb-4 space-y-2">
                            <li><strong>1 time: </strong> 30% discount on all products</li>
                        </ul>
                        <p class="text-xl font-bold text-gray-600">FREE/ month</p>
                    </div>

                    <!-- VIP Member -->
                    <div class="bg-slate-200 rounded-md shadow-md p-6 text-center">
                        <h3 class="text-4xl font-bold text-gray-600 font-extrabold mb-4">Gold Member</h3>
                        <ul class="text-gray-600 mb-4 space-y-2">
                            <li><strong>4 times:</strong> 30% discount on all products</li>
                        </ul>
                        <p class="text-xl font-bold text-gray-600">S$ 2.90/ month</p>
                    </div>

                    <!-- SuperVIP Member -->
                    <div class="bg-slate-300 rounded-md shadow-md p-6 text-center">
                        <h3 class="text-4xl font-bold text-gray-600 font-extrabold mb-4 flex flex-col">
                            <span>
                                Platinum Member
                            </span>
                            <small class="text-sm text-red-600">(Coming soon)</small>
                        </h3>
                        <ul class="text-gray-500 mb-4 space-y-2">
                            <li><strong>Unlimited:</strong> 30% discount on all products</li>
                            <li><strong>FREE:</strong> S$2 voucher</li>
                            <li><strong>Unlimited:</strong> Crazy after-meal deals</li>
                            <li><strong>Unlimited:</strong> 8% cashback on orders via Grab</li>
                            <li><strong>Unlimited:</strong> 8% discount from affiliated vending machines</li>

                        </ul>
                        <p class="text-xl font-bold text-gray-600">S$ 4.80/ month</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="bg-white py-8 px-6">
            <div class="text-center text-gray-600 text-2xl font-semibold tracking-wide md:w-3/5 mx-auto">
                <strong>New Sign-up:</strong> Free Gold Member package, with FREE upgrade to unlimited times of 30% discount on all products, for 2 months
            </div>
            <div class="flex flex-col md:flex-row w-full md:w-fit justify-self-center mt-6 gap-8 md:w-2/5 text-center mx-auto">
                <Link :href="route('register')" class="bg-yellow-300 py-8 px-16 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-3xl hover:bg-yellow-400">
                    <div class="flex flex-col space-y-2">
                        <span>
                            SIGN UP NOW
                        </span>
                        <span class="text-sm font-bold">
                            (no credit card required)
                        </span>
                    </div>
                </Link>
            </div>
        </section>

        <!-- Map Section -->
        <section class="pb-4 pt-4 md:pt-8 bg-white">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">DCVend Location</h2>
            </div>
            <div id="map" class="sm:col-span-6 items-center mx-auto w-11/12 md:w-10/12 h-96"></div>
        </section>

        <section class="pb-10 pt-2 bg-white px-4 md:px-16">
            <!-- Table Section -->
            <div class="container mx-auto md:max-w-6xl mt-2">
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="w-full border-collapse text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                            <tr>
                                <th class="border border-gray-300 px-4 py-3 text-center">Code</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Name</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Address</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Menu</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Map Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(vend, index) in dcvends" :key="vend.code" @click="highlightMarker(index)" class="cursor-pointer hover:bg-gray-50 transition duration-200">
                                <td class="border border-gray-300 px-4 py-2 text-center font-medium">{{ vend.code }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ vend.customer.name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ vend.customer.address.full_address }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <span @click="showChannel(vend)" class="text-blue-500 underline hover:cursor-point">
                                        Menu
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a :href="vend.customer.address.map_url" target="_blank" class="text-blue-500 underline">
                                        Navigate
                                    </a>
                                </td>
                            </tr>
                            <tr v-if="!dcvends || dcvends.length == 0">
                                <td class="border border-gray-300 px-4 py-2 text-center" colspan="5">No data available</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </GuestLayout>

<Channel
    v-if="showChannelModal"
    :vend="vendObject"
    :showModal="showChannelModal"
    @modalClose="onChannelClosed"
>
</Channel>

</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Channel from '@/Pages/Guest/Channel.vue';
import { MapIcon } from '@heroicons/vue/20/solid';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps({
    dcvends: [Array, Object],
    mapApiKey: String,
    stats: [Array, Object],
});

const showChannelModal = ref(false);
const dcvends = ref([]);
const vendObject = ref([]);

let map;
let directionsService;
let markers = []; // Array to store marker instances

onMounted(() => {
    dcvends.value = Array.isArray(props.dcvends?.data) ? props.dcvends.data : [];
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

                // Add self-marker
                addSelfMarker(userLocation);

                // Add customer markers
                addMarkers();
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
    // Add a marker for each customer
    dcvends.value.forEach((vend, index) => {
        const { customer } = vend;
        if (customer && customer.address) {
            const { latitude, longitude, full_address } = customer.address;

            if (latitude && longitude) {
                const position = {
                    lat: parseFloat(latitude),
                    lng: parseFloat(longitude),
                };

                const marker = new google.maps.Marker({
                    position,
                    map: map,
                    label: {
                        text: vend.code.toString(),
                        color: '#000000',
                        fontWeight: 'bold',
                    },
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 17,
                        fillColor: '#FF6F61', // Customer marker color
                        fillOpacity: 1,
                        strokeColor: '#FFFFFF',
                        strokeWeight: 2,
                    },
                    title: full_address,
                });

                // Attach info window to marker
                const infoWindow = new google.maps.InfoWindow({
                    content: `<div class="p-2 text-sm font-medium">${full_address}</div>`,
                });

                marker.addListener('mouseover', () => infoWindow.open(map, marker));
                marker.addListener('mouseout', () => infoWindow.close());

                markers.push({ marker, index });
            }
        }
    });

    // Optionally, add a fallback for debugging
    if (dcvends.value.length === 0) {
        console.warn('No customer data available for markers.');
    }
}

function addSelfMarker(userLocation) {
    new google.maps.Marker({
        position: userLocation,
        map: map,
        label: {
            text: 'You',
            color: '#000000',
            fontWeight: 'bold',
        },
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 13,
            fillColor: '#4CAF50', // Self-marker color
            fillOpacity: 1,
            strokeColor: '#FFFFFF',
            strokeWeight: 2,
        },
        title: 'Your Location',
    });
}

function highlightMarker(index) {

    if (markers[index]) {
        const { marker } = markers[index];

        // Animate the marker
        marker.setAnimation(google.maps.Animation.BOUNCE);

        // Stop animation after 2 seconds
        setTimeout(() => {
            marker.setAnimation(null);
        }, 2000);

        // Center the map on the selected marker
        map.setCenter(marker.getPosition());
        map.setZoom(14);
    }
}

function onChannelClosed() {
    showChannelModal.value = false
}

function showChannel(vend) {
    vendObject.value = vend
    showChannelModal.value = true
}
</script>


<style scoped>
header {
    font-family: 'Poppins', sans-serif;
}
</style>
