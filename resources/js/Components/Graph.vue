<template>
  <div class="md:hidden overflow-scroll">
      <Vue3ChartJs :height="410" id="chartjs" :type="type" :data="data" ref="chartRef" :plugins="plugins" :options="options">
      </Vue3ChartJs>
  </div>
  <div class="hidden md:block overflow-scroll">
      <Vue3ChartJs id="chartjs" :type="type" :data="data" ref="chartRef"  :plugins="plugins" :options="options">
      </Vue3ChartJs>
  </div>
</template>

<script setup>
  import Vue3ChartJs from '@j-t-mcc/vue3-chartjs';
  import 'chartjs-adapter-moment';
  import ChartDataLabels from 'chartjs-plugin-datalabels';
  import { ref } from 'vue'

  const props = defineProps({
      type: {
          type: String,
          default: 'line',
      },
      labels: [Array, Object, String],
      values: Object,
      options: Object,
      datasets: [Array, Object],
  });

  const chartRef = ref(null)
  const data = ref({
                  labels: props.labels,
                  datasets: props.datasets
              })
  const options = ref({
                  elements: {
                      point: {
                          radius: 2
                      }
                  },
                  ...props.options,
              })
  // const plugins = ref([ChartDataLabels])
  const plugins = ref()

</script>