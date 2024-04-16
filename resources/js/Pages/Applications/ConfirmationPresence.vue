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

const canEditPresence = computed(() => {
  return ['registered', 'confirmed_presence', 'canceled'].includes(props.application.state)
})

const cancelApplication = () => {
  router.post(route('fresques.applications.cancel', props.token))
}

const confirmApplication = () => {
  router.post(route('fresques.applications.confirm', props.token))
}
</script>

<template>
  <OverlayLayout
    head-title="Confirmation de votre participation"
    :redirect-url="route('fresques.show', { fresque })"
  >
    <div class="container">
      <div class="max-w-full w-[792px] mx-auto text-center mb-10">
        <div class="text-lg lg:text-xl mb-2">Votre prochaine Fresque du Bénévolat</div>
        <div class="text-xl lg:text-[28px] leading-10 font-bold">
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
            <h2 class="text-[32px] font-bold">
              <template v-if="application.state === 'registered'">
                Vous venez toujours {{ application.first_name }} ? 🥰
              </template>
              <template v-if="application.state === 'confirmed_presence'">
                Présence confirmée 👊
              </template>
              <template v-if="application.state === 'canceled'">
                Participation annulée 😢
              </template>
            </h2>
            <p class="text-lg">
              Votre participation est au statut: <strong>{{ application.state }}</strong>
            </p>
            <p class="text-lg px-12">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum accusantium
              assumenda quasi repudiandae a nulla deleniti vel. Magni dignissimos repellat non
              laboriosam totam, ratione, natus officiis architecto ut rem laudantium?
            </p>
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
          <!-- <div class="mb-12">
              <img class="h-[75px] w-[67px] mx-auto" src="/images/icons/hearts.svg" alt="" />
            </div>
            <div class="mb-12 space-y-8">
              <h2 class="text-[32px] font-bold">{{ application.full_name }}</h2>
              <p class="text-lg">
                Votre participation est au statut: <strong>{{ application.state }}</strong>
              </p>
            </div>
            <DsfrButton size="lg" full>Retour à la homepage</DsfrButton> -->
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
