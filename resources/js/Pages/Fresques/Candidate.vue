<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { router, useForm, usePage } from '@inertiajs/vue3'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import DsfrLabel from '@/Components/Dsfr/Label.vue'
import DsfrInput from '@/Components/Dsfr/Input.vue'

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
              <DsfrLabel for="first_name" class="" required>Prénom</DsfrLabel>
              <DsfrInput
                id="first_name"
                v-model="form.first_name"
                placeholder="Jean"
                :error="!!form.errors.first_name"
              />
            </div>
            <div>
              <DsfrLabel for="last_name" class="" required>Nom</DsfrLabel>
              <DsfrInput
                id="last_name"
                v-model="form.last_name"
                placeholder="Dupont"
                :error="!!form.errors.first_name"
              />
            </div>
            <div>
              <DsfrLabel for="email" class="" required>Adresse email</DsfrLabel>
              <DsfrInput
                id="email"
                v-model="form.email"
                type="email"
                placeholder="jean.dupont@mail.com"
                :error="!!form.errors.first_name"
              />
            </div>
            <div>
              <DsfrLabel for="mobile" class="" required>Numéro de téléphone</DsfrLabel>
              <DsfrInput
                id="mobile"
                v-model="form.mobile"
                placeholder="06 01 02 03 04"
                :error="!!form.errors.mobile"
              />
            </div>
          </div>
          <DsfrButton type="submit" size="lg" full>Je valide mon inscription</DsfrButton>
        </form>
      </div>
    </div>
  </OverlayLayout>
</template>
