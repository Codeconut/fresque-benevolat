<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, usePage } from '@inertiajs/vue3'
import DsfrButton from '@/Components/Dsfr/Button.vue'

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
  application: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <OverlayLayout
    title="Confirmation de votre participation"
    :redirect-url="route('fresques.show', { fresque })"
  >
    <div class="container">
      <div class="text-center mb-10">
        <div class="text-xl">Votre prochaine Fresque du Bénévolat</div>
        <div class="text-[28px] font-bold">
          À {{ fresque.place.city }}, le {{ $dayjs(fresque.date).format('DD MMMM YYYY') }} de
          {{ fresque.schedules }}
        </div>
      </div>
      <div class="max-w-full w-[792px] mx-auto">
        <div class="p-12 bg-white shadow-lg">
          <div class="mb-12">ICONE</div>
          <div class="mb-12">
            <h2>@TODO Confirmation de votre présence</h2>
          </div>
          <DsfrButton size="lg" full>Je confirme ma présence</DsfrButton>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
