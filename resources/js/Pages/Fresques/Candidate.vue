<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { Checkbox, Input, Label, Button } from '@/Components/Dsfr'

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
})

const onSubmit = () => {
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
    title="Je candidate à la Fresque du Bénévolat"
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
        <form @submit.prevent="onSubmit" class="p-12 bg-white shadow-lg">
          <div class="mb-12"><span class="text-[#C8191F]">*</span> Champs obligatoires</div>
          <div class="grid grid-cols-2 gap-6 mb-12">
            <div>
              <Label for="first_name" class="" required>Prénom</Label>
              <Input
                id="first_name"
                v-model="form.first_name"
                placeholder="Jean"
                :error="!!form.errors.first_name"
              />
            </div>
            <div>
              <Label for="last_name" class="" required>Nom</Label>
              <Input
                id="last_name"
                v-model="form.last_name"
                placeholder="Dupont"
                :error="!!form.errors.first_name"
              />
            </div>
            <div>
              <Label for="email" class="" required>Adresse email</Label>
              <Input
                id="email"
                v-model="form.email"
                type="email"
                placeholder="jean.dupont@mail.com"
                :error="!!form.errors.first_name"
              />
            </div>
            <div>
              <Label for="mobile" class="" required>Numéro de téléphone</Label>
              <Input
                id="mobile"
                v-model="form.mobile"
                placeholder="06 01 02 03 04"
                :error="!!form.errors.mobile"
              />
            </div>
          </div>
          <div class="mb-8">
            <Checkbox id="agree-emails" name="agree-emails" required
              >J’accepte de recevoir des emails de rappel de l’événement</Checkbox
            >
          </div>
          <Button type="submit" size="lg" full>Je valide mon inscription</Button>
        </form>
      </div>
    </div>
  </OverlayLayout>
</template>
