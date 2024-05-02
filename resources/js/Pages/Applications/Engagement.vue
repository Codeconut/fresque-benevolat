<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { RadiosGroup, Button, FormElement } from '@/Components/Dsfr'

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

const form = useForm({
  post_fresque_engagement: props.application.post_fresque_engagement || null,
})

const onSubmit = () => {
  console.log('onSubmit', form)
  form.submit(
    'post',
    route('fresques.applications.engagement-benevolat', {
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
        <div class="text-2xl lg:text-[28px] leading-10 font-bold">
          À {{ fresque.place.city }}, le {{ $dayjs(fresque.date).format('DD MMMM YYYY') }} de
          {{ fresque.schedules }}
        </div>
      </div>
      <div class="max-w-full w-[792px] mx-auto">
        <div class="p-8 lg:p-12 bg-white shadow-lg">
          <div class="text-center mb-8">
            <h2 class="text-[32px] font-bold mb-6">Raconte nous ton itinéraire</h2>
            <div class="text-lg lg:text-xl lg:px-12">
              Tu peux modifier ta réponse à n'importe quel moment, avec le lien envoyé dans l'email
              🙂
            </div>
          </div>

          <form @submit.prevent="onSubmit" class="">
            <div class="grid grid-cols-1 gap-8 mb-12">
              <FormElement
                name="realised_mission"
                label="As-tu réalisé une mission de bénévolat depuis cette fresque ?"
                required
                :error="form.errors?.post_fresque_engagement"
              >
                <RadiosGroup
                  name="donner_envie_lancer_benevolat"
                  v-model="form.post_fresque_engagement"
                  :options="[
                    { label: 'Oui', value: 'yes' },
                    { label: 'Pas encore, mais c\'est en bonne voie !', value: 'no_but_soon' },
                    { label: 'Pas pour le moment', value: 'not_yet' },
                  ]"
                  class=""
                />
              </FormElement>
            </div>
            <Button type="submit" size="lg" full>Enregistrer</Button>
          </form>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
