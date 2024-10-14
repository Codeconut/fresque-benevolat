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
  <div v-if="fresques.length" class="py-10 lg:py-20">
    <div class="container">
      <div class="mb-16">
        <h2 class="relative text-4xl lg:text-5xl lg:leading-[56px] font-bold mb-4">
          Les prochaines fresques
        </h2>
      </div>
    </div>

    <div class="overflow-x-hidden">
      <div class="">
        <div class="flex flex-wrap gap-6 justify-center pb-8">
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

<style lang="postcss" scoped></style>
