<script setup>
defineProps({
  place: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="bg-white p-10">
    <div>{{ place.name }}</div>
    <div>{{ place.full_address }}</div>
    <div>CARTE ?</div>
    <div class="">
      <div v-for="(photo, i) in place.photos" :key="i" class="w-full">
        <img :src="`/storage/${photo}`" alt="" class="h-[300px] object-cover" />
      </div>
    </div>
  </div>
</template>
