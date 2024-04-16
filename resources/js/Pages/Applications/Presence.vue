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
    head-title="Confirmation de votre participation"
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
        <div class="p-12 bg-white shadow-lg text-center">
          <div class="mb-12">
            <img class="h-[75px] w-[67px] mx-auto" src="/images/icons/hearts.svg" alt="" />
          </div>
          <div class="mb-12 space-y-8">
            <h2 class="text-[32px] font-bold">Vous venez toujours ? 🥰</h2>
            <p class="text-lg">
              Votre participation est au statut: <strong>{{ application.state }}</strong>
            </p>
            <p class="text-lg px-12">
              Savoir le nombre exact de participants est crucial pour que je puisse organiser
              l’atelier de la meilleure façon possible.
            </p>
          </div>
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <DsfrButton size="lg" variant="secondary">J'annule mon inscription 😢</DsfrButton>
            <DsfrButton size="lg">Je confirme ma présence 👊</DsfrButton>
          </div>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
