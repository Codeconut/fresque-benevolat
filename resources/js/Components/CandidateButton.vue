<script setup>
import DsfrTag from '@/Components/Dsfr/Tag.vue'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import DialogModal from '@/Components/Jetstream/DialogModal.vue'
import TextInput from '@/Components/Jetstream/TextInput.vue'
import InputError from '@/Components/Jetstream/InputError.vue'
import { ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { RiTimeLine, RiCalendarEventLine } from '@remixicon/vue'

const form = useForm({
  email: '',
  first_name: '',
  last_name: '',
})

const showModal = ref(false)
const closeModal = () => {
  showModal.value = false

  form.reset()
}

const fresque = usePage().props.fresque

const onSubmit = () => {
  form.submit(
    'post',
    route('fresques.candidate', {
      fresque: fresque.slug,
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
        closeModal()
      },
      onFinish: () => {
        form.processing = false
      },
    }
  )
}
</script>

<template>
  <div>
    <DsfrButton @click="showModal = true"><slot /></DsfrButton>
    <DialogModal :show="showModal" @close="closeModal">
      <template #title> Inscription </template>
      <template #content>
        <div class="mb-4 flex space-x-4">
          <DsfrTag :icon="RiCalendarEventLine">{{ fresque.date }}</DsfrTag>
          <DsfrTag :icon="RiTimeLine">{{ fresque.schedules }}</DsfrTag>
        </div>
        <div class="">{{ fresque.place.city }}</div>
        <div class="">{{ fresque.place.full_address }}</div>
        <form @submit.prevent="onSubmit" class="mt-8">
          <div>
            <TextInput id="first_name" v-model="form.email" placeholder="E-mail" />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>
          <div>
            <TextInput id="first_name" v-model="form.first_name" placeholder="Prénom" />
            <InputError :message="form.errors.first_name" class="mt-2" />
          </div>
          <div>
            <TextInput id="last_name" v-model="form.last_name" placeholder="Nom" />
            <InputError :message="form.errors.last_name" class="mt-2" />
          </div>
        </form>
      </template>
      <template #footer>
        <DsfrButton
          class="ms-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="onSubmit"
        >
          Je m'inscris
        </DsfrButton>
      </template>
    </DialogModal>
  </div>
</template>
