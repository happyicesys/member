<template #dp-input="value">
  <div>
    <label for="text" class="block text-sm font-medium text-gray-700">
      <slot></slot>
    </label>
    <div class="mt-1 flex items-center rounded-md">
      <Datepicker
        :modelValue="modelValue"
        @update:modelValue="onSelected"
        format="yyyy-MM-dd"
        :clearable="clearable"
        :monthChangeOnScroll="false"
        autoApply
        :closeOnAutoApply="true"
        :minDate="minDate"
        :maxDate="maxDate"
        :enableTimePicker="enableTimePicker"
        :disabled="disabled"
        class="flex-grow"
        :class="{ 'cursor-not-allowed': disabled }"
        style="min-width: 150px; width: auto;"
      />
      <button
        type="button"
        class="border border-gray-300 bg-gray-50 px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
        @click="onPreviousDateClicked"
        v-if="isPreviousNextButton"
      >
        <ChevronDoubleLeftIcon class="h-4 w-4" aria-hidden="true" />
      </button>
      <button
        type="button"
        class="rounded-r-md border border-gray-300 bg-gray-50 px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
        @click="onNextDateClicked"
        v-if="isPreviousNextButton"
      >
        <ChevronDoubleRightIcon class="h-4 w-4" aria-hidden="true" />
      </button>
    </div>
  </div>
</template>

<style>
.datepicker {
  position: relative;
  z-index: 99999; /* Add a high value here */
}
</style>

<script setup>
  import Datepicker from '@vuepic/vue-datepicker';
  import { ChevronDoubleLeftIcon, ChevronDoubleRightIcon, XCircleIcon } from '@heroicons/vue/20/solid';
  import '@vuepic/vue-datepicker/dist/main.css'
  import moment from 'moment';

  const emit = defineEmits(['update:modelValue'])

  const props = defineProps({
    clearable: {
      type: [Boolean, String],
      default: true,
    },
    disabled: [Boolean, String],
    modelValue: [Date, String, Object],
    minDate: [Date, String, Object],
    maxDate: [Date, String, Object],
    enableTimePicker: {
      type: Boolean,
      default: false,
    },
    isPreviousNextButton: {
      type: [Boolean, String],
      default: true,
    },
  })

  function onPreviousDateClicked() {
    emit('update:modelValue', moment(props.modelValue).subtract(1, 'days').format('YYYY-MM-DD'))
  }

  function onNextDateClicked() {
    emit('update:modelValue', moment(props.modelValue).add(1, 'days').format('YYYY-MM-DD'))
  }

  function onSelected(modelData) {
    emit('update:modelValue', moment(modelData).format('YYYY-MM-DD'))
  }
</script>
