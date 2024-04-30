<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, usePage } from '@inertiajs/vue3'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import { computed } from 'vue'

const props = defineProps({
  token: {
    type: String,
    required: true,
  },
  fresque: {
    type: Object,
    required: true,
  },
  application: {
    type: Object,
    required: true,
  },
})

const cancelApplication = () => {
  router.post(route('fresques.applications.cancel', props.token))
}

const confirmApplication = () => {
  router.post(route('fresques.applications.confirm', props.token))
}

const title = computed(() => {
  switch (props.application.state) {
    case 'registered':
      return `Tu viens toujours ${props.application.first_name} ? 🥰`
    case 'confirmed_presence':
      return 'Présence confirmée 👊'
    case 'canceled':
      return 'Participation annulée 😢'
    default:
      return 'Votre participation'
  }
})
</script>

<template>
  <OverlayLayout
    head-title="Confirmation de votre participation"
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
              class="h-[75px] w-[67px] mx-auto text-[#6B93F6]"
              src="/images/icons/coeur-2.svg"
              alt=""
            />
          </div>
          <div class="mb-12 space-y-8">
            <h2 class="text-[32px] font-bold">
              {{ title }}
            </h2>
            <p class="text-lg">
              Ta participation est au statut:
              <strong>{{ $taxonomies.getLabel(application.state, 'application_states') }}</strong>
            </p>

            <template v-if="application.state === 'registered'">
              <p class="text-lg lg:px-12">
                Pour préparer au mieux la fresque, on a besoin de savoir si tu seras bien présent.
                En tout cas, nous, <strong>on compte sur toi</strong> !
              </p>
              <p class="text-lg lg:px-12">
                Si tu ne peux plus venir, pas de problème, annule ton inscription, et libére la
                place pour quelqu’un d’autre.
              </p>
            </template>
            <template v-if="application.state === 'confirmed_presence'">
              <p class="text-lg lg:px-12">
                Tu fais partie des chanceux qui participeront à cette fresque. En tout cas, nous, on
                a hâte de t'y retrouver !
              </p>
              <p class="text-lg lg:px-12">
                Si tu ne peux plus venir, pas de problème, annule ton inscription, et libére la
                place pour quelqu’un d’autre.
              </p>
            </template>
            <template v-if="application.state === 'canceled'">
              <p class="text-lg lg:px-12">
                Tu ne seras donc pas des nôtres .. Mais ce n’est que partie remise !
              </p>
              <p class="text-lg lg:px-12">
                Si tu changes d’avis, et souhaites malgré tout participer à cette super fresque, dis
                le nous en confirmant ta présence.
              </p>
            </template>
          </div>

          <template v-if="application.state === 'registered'">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              <DsfrButton size="lg" variant="secondary" @click="cancelApplication"
                >J'annule mon inscription 😢</DsfrButton
              >
              <DsfrButton size="lg" @click="confirmApplication"
                >Je confirme ma présence 👊</DsfrButton
              >
            </div>
          </template>

          <template v-if="application.state === 'confirmed_presence'">
            <DsfrButton size="lg" @click="cancelApplication" full variant="secondary"
              >J'annule mon inscription 😢</DsfrButton
            >
          </template>
          <template v-if="application.state === 'canceled'">
            <DsfrButton size="lg" @click="confirmApplication" full
              >Je confirme ma présence 👊</DsfrButton
            >
          </template>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
