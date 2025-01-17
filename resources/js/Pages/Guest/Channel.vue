<template>
  <Teleport to="body">
    <Modal :open="showModal" @modalClose="$emit('modalClose')">
      <template #header>
        <div class="flex flex-col space-y-3">
          <div class="flex flex-col md:flex-row md:space-x-3 space-y-1">
            <span class="text-gray-600 text-sm">
              Machine
              <span v-if="vend.code">ID {{ vend.code }}</span>
            </span>
            <span v-if="vend.customer">
              {{ vend.customer?.name }}
            </span>
          </div>
          <span class="text-sm text-gray-500">
            Loaded at {{ timingNow }}
          </span>
        </div>
      </template>

      <template #default>
        <div class="flex flex-col">
          <!-- Desktop View -->
          <div class="hidden md:block overflow-x-auto">
            <div class="inline-block min-w-full py-2 align-middle">
              <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-4 py-3 text-xs font-semibold text-gray-900 text-center">#</th>
                      <th scope="col" class="px-4 py-3 text-xs font-semibold text-gray-900 text-center">Image</th>
                      <th scope="col" class="px-4 py-3 text-xs font-semibold text-gray-900 text-center">Status</th>
                      <th scope="col" class="px-4 py-3 text-xs font-semibold text-gray-900 text-center">Product</th>
                    </tr>
                  </thead>

                  <tbody class="bg-white">
                    <tr
                      v-for="(channel, index) in channels"
                      :key="channel.id"
                      :class="{
                        'bg-gray-50': index % 2 !== 0,
                      }"
                      class="cursor-pointer hover:bg-gray-200"
                      @click="highlightChannel(index)"
                    >
                      <td class="px-4 py-3 text-center">{{ channel.code }}</td>
                      <td class="px-4 py-3">
                        <img
                          v-if="channel.product?.thumbnail?.full_url"
                          :src="channel.product.thumbnail.full_url"
                          alt="Product Image"
                          class="w-20 h-20 rounded-full mx-auto"
                        />
                      </td>
                      <td class="px-4 py-3 text-center">
                        <span
                          :class="{
                            'bg-green-200 text-green-800': channel.qty >= 3,
                            'bg-orange-200 text-orange-800': channel.qty >= 1 && channel.qty < 3,
                            'bg-red-200 text-red-800': channel.qty == 0 || channel.vend_channel_error_logs?.length,
                          }"
                          class="px-3 py-1 rounded-full text-sm font-bold"
                        >
                          {{ getStatusLabel(channel) }}
                        </span>
                      </td>
                      <td class="px-4 py-3 text-center text-sm text-gray-700">
                        {{ channel.product?.name || 'N/A' }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Mobile View -->
          <div class="md:hidden space-y-2">
            <div
              v-for="(channel, index) in channels"
              :key="channel.id"
              class="p-4 bg-white shadow rounded-lg space-y-2"
              @click="highlightChannel(index)"
            >
              <!-- <div class="flex items-center justify-between">
                <span class="text-gray-600 font-semibold"># {{ channel.code }}</span>
              </div> -->
              <div class="flex items-center space-x-2">
                <span class="text-gray-600 font-normal"># {{ channel.code }}</span>
                <img
                  v-if="channel.product?.thumbnail?.full_url"
                  :src="channel.product.thumbnail.full_url"
                  alt="Product Image"
                  class="w-24 h-24 rounded-full"
                />
                <div class="flex-1 space-y-1 ">
                  <p class="text-gray-700 text-lg text-center">{{ channel.product?.name || 'N/A' }}</p>
                  <span
                    :class="{
                      'bg-green-200 text-green-800': channel.qty >= 3,
                      'bg-orange-200 text-orange-800': channel.qty >= 1 && channel.qty < 3,
                      'bg-red-200 text-red-800': channel.qty == 0 || channel.vend_channel_error_logs?.length,
                    }"
                    class="px-3 py-1 rounded-full text-sm font-bold block text-center w-fit mx-auto"
                  >
                    {{ getStatusLabel(channel) }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
    </Modal>
  </Teleport>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
  showModal: Boolean,
  timingNow: String,
  vend: Object,
});

const emit = defineEmits(['modalClose']);
const channels = ref([]);
const highlightedChannel = ref(null);

onMounted(() => {
  channels.value = props.vend.vendChannels.map((channel) => ({
    ...channel,
    product: channel.product || {},
  }));
});

function highlightChannel(index) {
  highlightedChannel.value = index;
}

function getStatusLabel(channel) {
  if (channel.qty >= 3) return 'More than 3 pcs';
  if (channel.qty >= 1 && channel.qty < 3) return 'Less than 3 pcs';
  if (channel.qty == 0 || channel.vend_channel_error_logs?.length) return 'Sold Out';
  return 'Unknown';
}
</script>

<style scoped>
.cursor-pointer {
  transition: background-color 0.3s ease;
}
.bg-green-200 {
  background-color: #d4f5e2;
}
.text-green-800 {
  color: #2f855a;
}
.bg-orange-200 {
  background-color: #fbd38d;
}
.text-orange-800 {
  color: #c05621;
}
.bg-red-200 {
  background-color: #fed7d7;
}
.text-red-800 {
  color: #c53030;
}
</style>
