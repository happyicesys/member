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
                <div class="bg-yellow-300 py-3 md:py-6 px-10 rounded-lg shadow-md">
                    <p class="text-xl md:text-2xl font-bold text-gray-600 flex flex-col  items-center space-y-2">
                        <span class="text-3xl md:text-5xl font-extrabold drop-shadow-sm">
                            S$ {{ (stats['promo_amount']/ (Math.pow(10, 2))).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) }}
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
                <Link :href="route('register', { refID: 'web' })" class="bg-yellow-300 py-8 px-16 rounded-lg shadow-md border-2 border-red-600 text-red-600 font-extrabold text-5xl hover:bg-yellow-400">
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

                <!-- Product Section -->
        <section class="pb-4 pt-4 md:pt-8 bg-white">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">Discover Our Products</h2>
            </div>
            <img src="/images/menu_desktop_v1.jpg" alt="DCVend Products" class="rounded hidden md:block w-2/3 mx-auto"/>
            <img src="/images/menu_mobile_v1.jpg" alt="DCVend Products Mobile" class="w-full px-4 rounded md:hidden">
        </section>

        <!-- Map Section -->
        <section class="pb-4 pt-4 md:pt-8 bg-white">
            <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-6">DCVend Location</h2>
            </div>
            <div id="map" class="sm:col-span-6 items-center mx-auto w-11/12 md:w-10/12 h-[30rem]"></div>
        </section>

        <section class="pb-10 pt-2 bg-white px-4 md:px-16">
            <!-- Table Section -->
            <div class="container mx-auto md:max-w-6xl mt-2">
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="w-full border-collapse text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                            <tr>
                                <th class="border border-gray-300 px-4 py-3 text-center">No.</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Name</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Address</th>
                                <th class="border border-gray-300 px-4 py-3 text-center">Product Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(vendData, index) in dcvends" :key="vendData.id" @click="highlightMarker(index)" class="cursor-pointer hover:bg-gray-50 transition duration-200">
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-col space-y-2">
                                        <span class="text-gray-800 text-center">
                                            {{ index + 1 }}
                                        </span>
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-col space-y-2">
                                        <span class="text-gray-800 font-semibold text-left">
                                            {{ vendData.vend?.code }}
                                        </span>
                                        <span class="text-left">
                                            <div class="flex flex-col space-y-1">
                                                <div>
                                                    {{ vendData.name }}
                                                </div>
                                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10 w-fit" v-if="vendData.is_restricted_access">Restricted Access</span>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-col space-y-2">
                                        <span>
                                            {{ vendData.address?.full_address }}
                                        </span>
                                        <a
                                            :href="`https://www.google.com/maps/search/?api=1&query=${vendData.address.latitude},${vendData.address.longitude}`"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="bg-green-300 hover:bg-green-400 px-3 py-2 text-xs text-green-800 flex space-x-1 w-fit rounded shadow font-bold"
                                            v-if="vendData.address?.latitude && vendData.address?.longitude"
                                        >
                                            GPS
                                        </a>
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <!-- <img src="/images/components/ice_cream_stick.png" alt="Ice cream icon" class="hover:cursor-point drop-shadow-lg mx-auto w-10 h-10" @click="showChannel(vendData.vend)" v-if="vendData.vend"> -->
                                    <span @click="showChannel(vendData.vend)" v-if="vendData.vend" class="text-blue-600 hover:underline">Check</span>
                                </td>
                            </tr>
                            <tr v-if="!dcvends || dcvends.length === 0">
                                <td class="border border-gray-300 px-4 py-2 text-center" colspan="3">No data available</td>
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
    :timingNow="now"
    @modalClose="onChannelClosed"
>
</Channel>

<AttachmentList :items="photos" :isEditEnabled="false"></AttachmentList>

</template>

<script setup>
import AttachmentList from '@/Components/AttachmentList.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Channel from '@/Pages/Guest/Channel.vue';
import { MagnifyingGlassCircleIcon } from '@heroicons/vue/20/solid';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';
import Swiper from 'swiper';
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps({
    dcvends: [Array, Object],
    mapApiKey: String,
    stats: [Array, Object],
});

const now = ref(moment().format('hh:mm:ss a'))
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
    const defaultPos = { lat: 1.3521, lng: 103.8198 }; // Center of Singapore

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultPos,
        zoom: 12,
    });

    addMarkers();
}

function addMarkers() {
    markers = []; // Reset the markers array

    dcvends.value.forEach((vendData, tableIndex) => {
        const { address, photos, name, vend } = vendData;

        if (address && address.latitude && address.longitude) {
            const position = {
                lat: parseFloat(address.latitude),
                lng: parseFloat(address.longitude),
            };

            const marker = new google.maps.Marker({
                position,
                map: map,
                label: {
                    text: String(vend.code),
                    color: '#000000',
                    fontWeight: 'bold',
                },
                icon: {
                    url: '/images/icon.png', // Path to your custom icon
                    scaledSize: new google.maps.Size(40, 40), // Resize the icon
                    labelOrigin: new google.maps.Point(20, 40),
                },
                title: address.full_address,
            });

            // Prepare images for the info window
            let photoSliderHtml = '';

            if (photos && photos.length > 0) {
                photoSliderHtml = `
                    <div style="max-width: 500px; max-height: 400px; height:auto; overflow: hidden;">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                ${photos
                                    .map(
                                        (photo) => `
                                        <div class="swiper-slide">
                                            <img src="${photo.full_url}" alt="Customer Photo" style="width: 100%; height: auto; border-radius:5%;" @click="showAttachment(photos)"/>
                                        </div>`
                                    )
                                    .join('')}
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>`;
            }

            // Create an info window
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="text-align: center;">
                        <span style="font-size: 12px; font-weight: bold; margin-bottom: 1px;">${name}</span>
                        <p style="margin-bottom: 3px;"><strong>${address.full_address}</strong></p>
                        ${photoSliderHtml}
                    </div>
                `,
                maxWidth: 1000,
            });

            marker.addListener('click', () => {
                event.stopPropagation();
                infoWindow.open(map, marker);

                // Initialize Swiper after the info window is opened
                setTimeout(() => {
                    new Swiper('.swiper', {
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        loop: true,
                    });
                }, 0);
            });

            markers.push({ marker, tableIndex });
        }
    });
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

function highlightMarker(tableIndex) {
    const markerObj = markers.find((m) => m.tableIndex === tableIndex);
    if (markerObj) {
        const { marker } = markerObj;

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
    vendObject.value = []
    vendObject.value = vend
    console.log(vendObject.value)
    showChannelModal.value = true
}

function showAttachment() {
    console.log('show attachment')
}
</script>


<style scoped>
header {
    font-family: 'Poppins', sans-serif;
}

/* Style the navigation buttons */
.swiper-button-next,
.swiper-button-prev {
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    color: #fff; /* White arrow color */
    border-radius: 50%; /* Make it circular */
    width: 30px; /* Smaller width */
    height: 30px; /* Smaller height */
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
}

/* Adjust arrow size */
.swiper-button-next::after,
.swiper-button-prev::after {
    font-size: 14px; /* Smaller arrow size */
    font-weight: bold;
}

/* Hover effect */
.swiper-button-next:hover,
.swiper-button-prev:hover {
    background-color: rgba(0, 0, 0, 0.8); /* Darker background on hover */
    transform: scale(1.1); /* Slight zoom effect */
    transition: background-color 0.3s ease, transform 0.3s ease;
}

</style>
