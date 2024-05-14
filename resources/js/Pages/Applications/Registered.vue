<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, usePage, Link } from '@inertiajs/vue3'
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
      <div class="max-w-full w-[792px] mx-auto text-center mb-10">
        <div class="text-lg lg:text-xl mb-2">Ta prochaine Fresque du Bénévolat</div>
        <div class="text-2xl lg:text-[28px] leading-10 font-bold">
          À {{ fresque.place.city }}, le {{ $dayjs(fresque.date).format('DD MMMM YYYY') }} de {{
            fresque.schedules
          }}
        </div>
      </div>
      <div class="max-w-full w-[792px] mx-auto">
        <div class="p-8 lg:p-12 bg-white shadow-lg text-center">
          <div class="mb-6 lg:mb-12">
            <img
              v-svg-inline
              class="h-[75px] w-[67px] mx-auto text-[#6B93F6] focus:outline-none"
              :src="`${$page.props.assetUrl}/images/icons/coeur-2.svg`"
              alt=""
            />
          </div>
          <div class="mb-12 space-y-8">
            <h2 class="text-[28px] lg:text-[32px] font-bold">
              Félicitations {{ application.first_name }} !
            </h2>
            <p class="text-lg">Tu recevras un email de rappel avant la Fresque.</p>
            <p class="text-lg lg:px-12">
              Un empêchement ? Pas de panique, tu peux te servir du lien dans le mail que tu viens
              de recevoir pour nous prévenir.
            </p>
            <p class="text-lg font-bold">À bientôt !</p>
          </div>
          <Link :href="route('fresques.show', { fresque: props.fresque })">
            <DsfrButton full size="lg">Retour à la page d’accueil</DsfrButton>
          </Link>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
