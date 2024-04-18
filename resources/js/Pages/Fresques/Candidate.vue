<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { Checkbox, Input, Label, Button, FormElement } from '@/Components/Dsfr'

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const form = useForm({
  email: '',
  first_name: '',
  last_name: '',
  has_accepted_emails: null,
})

const onSubmit = () => {
  console.log('onSubmit', form)
  form.submit(
    'post',
    route('fresques.apply', {
      fresque: props.fresque,
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
  <OverlayLayout
    :head-title="`À ${fresque.place.city}, le ${$dayjs(fresque.date).format('DD MMMM YYYY')} de
          ${fresque.schedules}`"
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
      <div class="flex flex-col max-w-full w-[792px] mx-auto">
        <form @submit.prevent="onSubmit" class="p-8 lg:p-12 bg-white shadow-lg">
          <div class="mb-6 lg:mb-12"><span class="text-[#C8191F]">*</span> Champs obligatoires</div>
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-12">
            <FormElement name="first_name" label="Prénom" required :error="form.errors.first_name">
              <Input
                name="first_name"
                v-model="form.first_name"
                placeholder="Jean"
                :error="!!form.errors.first_name"
              />
            </FormElement>
            <FormElement name="last_name" label="Nom" required :error="form.errors.last_name">
              <Input
                name="last_name"
                v-model="form.last_name"
                placeholder="Dupont"
                :error="!!form.errors.last_name"
              />
            </FormElement>
            <FormElement name="email" label="Adresse email" required :error="form.errors.email">
              <Input
                name="email"
                v-model="form.email"
                type="email"
                placeholder="jean.dupont@mail.com"
                :error="!!form.errors.email"
              />
            </FormElement>
            <FormElement
              name="mobile"
              label="Numéro de téléphone"
              :error="form.errors.mobile"
              info="Pour vous contacter en cas de besoin :)"
            >
              <Input
                name="mobile"
                v-model="form.mobile"
                placeholder="06 01 02 03 04"
                :error="!!form.errors.mobile"
              />
            </FormElement>
          </div>
          <div class="mb-8">
            <Checkbox
              v-model="form.has_accepted_emails"
              name="has_accepted_emails"
              :error="!!form.errors.has_accepted_emails"
              required
              >J’accepte de recevoir des emails de rappel de l’événement</Checkbox
            >
          </div>
          <Button type="submit" size="lg" full>Je valide mon inscription</Button>
        </form>
      </div>
    </div>
  </OverlayLayout>
</template>
