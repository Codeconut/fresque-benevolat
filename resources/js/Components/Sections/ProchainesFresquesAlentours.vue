<script setup>
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Button } from '@/Components/Dsfr'

const props = defineProps({
  fresques: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <div class="py-10 lg:py-20">
    <div class="container">
      <div class="text-center mb-16">
        <h2 class="relative text-3xl lg:text-5xl leading-[56px] font-bold mb-4">
          Les prochaines fresques aux alentours
        </h2>
      </div>
    </div>

    <div class="overflow-x-hidden">
      <div class="container">
        <div class="flex flex-wrap gap-12 justify-center pb-8">
          <Link
            :href="route('fresques.show', { fresque: fresque.slug })"
            v-for="fresque in fresques"
            :key="fresque.id"
          >
            <FresqueCard class="" :fresque="fresque" orientation="vertical" />
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.swiper {
  @apply overflow-visible;
  :deep(.swiper-slide) {
    @apply max-w-[384px] w-full;
  }
  :deep(.swiper-pagination) {
    @apply text-left relative mt-8;
    .swiper-pagination-bullet {
      @apply w-[10px] h-[10px];
      background-color: #e1cab0;
      &-active {
        background-color: #a38f78;
      }
    }
  }
}
</style>
