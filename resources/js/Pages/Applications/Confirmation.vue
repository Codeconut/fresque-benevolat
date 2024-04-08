<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, usePage } from '@inertiajs/vue3'
import DsfrButton from '@/Components/Dsfr/Button.vue'

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const onButtonClick = () => {
  router.visit(route('fresques.show', { fresque: props.fresque }))
}
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
        <div class="p-12 bg-white shadow-lg text-center">
          <div class="mb-12">
            <img class="h-[75px] w-[67px] mx-auto" src="/images/hearts.svg" alt="" />
          </div>
          <div class="mb-12 space-y-8">
            <h2 class="text-[32px] font-bold">Félicitations pour avoir sauté le pas !</h2>
            <p class="text-lg">Vous recevrez un email de rappel avant votre Fresque.</p>
            <p class="text-lg px-12">
              Si vous ne pouvez plus participer, écrivez-nous à mail@mail.com pour nous prévenir.
            </p>
            <p class="text-lg font-bold">À bientôt !</p>
          </div>
          <DsfrButton full size="lg" @click="onButtonClick">Retour à la homepage</DsfrButton>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
