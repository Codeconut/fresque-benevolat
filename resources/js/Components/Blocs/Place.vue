<script setup>
import MarkdownIt from 'markdown-it'
import { Button } from '@/Components/Dsfr'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'
import { Head, Link, router } from '@inertiajs/vue3'

defineProps({
  place: {
    type: Object,
    required: true,
  },
})
const markdown = new MarkdownIt()
</script>

<template>
  <div class="bg-white shadow-lg p-8 lg:p-12">
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 gap-8">
      <div class="flex-1">
        <div class="text-[22px] font-bold">{{ place.name }}</div>
        <div class="text-lg">{{ place.full_address }}</div>
      </div>
      <a :href="`https://www.google.com/maps?q=${place.full_address}`" target="_blank">
        <Button variant="secondary"> Comment s'y rendre ?</Button>
      </a>
    </div>

    <Swiper :modules="[Pagination, A11y]" :pagination="{ clickable: true }" :spaceBetween="24">
      <SwiperSlide v-for="(photo, i) in place.photos_urls" :key="i">
        <img :src="`${photo}`" alt="" class="object-cover rounded-lg" />
      </SwiperSlide>
    </Swiper>

    <div v-if="place.summary" class="mt-8">
      <div class="markdown" v-html="markdown.render(place.summary)" />
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.swiper {
  :deep(.swiper-wrapper) {
    @apply rounded-lg;
  }
  :deep(.swiper-pagination) {
    @apply text-left relative mt-4;
    .swiper-pagination-bullet {
      @apply w-[10px] h-[10px] opacity-100;
      background-color: #e1cab0;
      &-active {
        background-color: #a38f78;
      }
    }
  }
}
</style>
