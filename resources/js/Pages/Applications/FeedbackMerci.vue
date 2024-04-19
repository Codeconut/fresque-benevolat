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

console.log('props.feedback', props.feedback)
const form = useForm({
  rating: props.feedback?.rating || 3,
  questions: {
    donner_envie_lancer_benevolat: props.feedback?.questions?.donner_envie_lancer_benevolat || null,
    comment_as_tu_trouve_les_animations:
      props.feedback?.questions?.comment_as_tu_trouve_les_animations || null,
    comment_as_tu_trouve_les_animateurs:
      props.feedback?.questions?.comment_as_tu_trouve_les_animateurs || null,
    as_tu_trouve_le_lieu_approprié:
      props.feedback?.questions?.as_tu_trouve_le_lieu_approprié || null,
    quest_ce_que_tu_as_adore: props.feedback?.questions?.quest_ce_que_tu_as_adore || null,
    quest_ce_qui_ta_manque: props.feedback?.questions?.quest_ce_qui_ta_manque || null,
    quaurais_tu_enleve_a_cette_fresque:
      props.feedback?.questions?.quaurais_tu_enleve_a_cette_fresque || null,
    quaurais_tu_fais_differement: props.feedback?.questions?.quaurais_tu_fais_differement || null,
    serais_tu_interesse_pour_devenir_animateur:
      props.feedback?.questions?.serais_tu_interesse_pour_devenir_animateur || null,
  },
})

const onSubmit = () => {
  console.log('onSubmit', form)
  form.submit(
    'post',
    route('fresques.applications.feedback.updateOrCreate', {
      fresqueApplication: props.token,
    }),
    {
      //preserveScroll: false,
      onStart: () => {
        form.processing = true
      },
      onError: () => {
        console.log('onError', form.errors)
      },
      onSuccess: () => {
        console.log('onSuccess', form)
      },
      onFinish: () => {
        form.processing = false
      },
    }
  )
}
</script>

<template>
  <OverlayLayout head-title="Feedback" :redirect-url="route('fresques.show', { fresque })">
    <div class="container">
      <div class="max-w-full w-[792px] mx-auto text-center mb-10">
        <div class="text-lg lg:text-xl mb-2">
          Un grand merci pour ta participation à la Fresque du Bénévolat !
        </div>
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
            <h2 class="text-[32px] font-bold">Merci pour ton feedback ! 😄</h2>
            <p class="text-lg">Nous avons été ravis d'animer cette fresque avec toi !</p>
            <p class="text-lg">
              Pour toute question tu peux contacter Coralie par mail<br />
              <strong>coralie.chauvin@beta.gouv.fr</strong>
            </p>
          </div>
          <a href="https://jeveuxaider.gouv.fr" target="_blank">
            <DsfrButton full size="lg">Trouver une mission JeVeuxAider.gouv.fr</DsfrButton>
          </a>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
