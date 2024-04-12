<script setup>
defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="overflow-hidden">
    <div
      class="w-0 h-0 border-t-[60px] border-t-transparent border-l-[1284px] border-l-dsfr-yellow-active border-b-[0px] border-b-transparent"
    ></div>
    <div class="p-8 lg:p-16 bg-dsfr-yellow-active">
      <div class="">
        <h1 class="text-4xl font-bold">{{ fresque.place.city }}</h1>
        <img
          v-if="fresque.cover"
          :src="fresque.cover ? `/storage/${fresque.cover}` : '/images/default-placeholder.png'"
          alt="fresque"
          class="w-full h-[430px] object-cover"
        />
      </div>
    </div>
  </div>
</template>
