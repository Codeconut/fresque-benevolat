<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import { computed } from 'vue'

import { Input, Button, FormElement } from '@/Components/Dsfr'

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
  feedback: {
    type: Object,
  },
})
</script>

<template>
  <OverlayLayout head-title="Feedback" :redirect-url="route('fresques.show', { fresque })">
    <div class="container">
      <div class="max-w-full w-[792px] mx-auto text-center mb-10">
        <div class="text-lg lg:text-xl mb-2">
          Un grand merci pour ta participation à la Fresque du Bénévolat !
        </div>
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
              class="h-[75px] w-[67px] mx-auto"
              :src="`${$page.props.assetUrl}/images/icons/hearts.svg`"
              alt=""
            />
          </div>
          <div class="mb-12 space-y-8">
            <h2 class="text-[32px] font-bold">Merci pour ton feedback ! 😄</h2>
            <p class="text-lg">Nous avons été ravis d'animer cette fresque avec toi !</p>
            <p class="text-lg">
              Pour toute question tu peux contacter le support par mail<br />
              <strong>supportfresque@jeveuxaider.beta.gouv.fr</strong>
            </p>
            <p class="text-lg">
              Et pour trouver des supers missions de bénévolat, près de chez toi ou à distance,
              rendez-vous sur JeVeuxAider.gouv.fr. Il y en a pour tous les goûts et toutes les
              façons d’agir.
            </p>
          </div>
          <a href="https://jeveuxaider.gouv.fr" target="_blank">
            <DsfrButton full size="lg">Trouver une mission de bénévolat</DsfrButton>
          </a>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
