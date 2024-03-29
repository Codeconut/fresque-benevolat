<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  fresques: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <AppLayout title="Fresques Benevolat">
    <div v-if="fresques" class="container py-24">
      <div class="grid grid-cols-1 gap-8">
        <Link
          :href="route('fresques.show', { fresque: fresque.slug })"
          v-for="fresque in fresques.data"
          :key="fresque.id"
        >
          <FresqueCard class="" :fresque="fresque" />
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
