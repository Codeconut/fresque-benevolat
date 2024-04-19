<script setup>
import { Button, Input, FormElement } from '@/Components/Dsfr'
import { useForm } from '@inertiajs/vue3'
import {
  RiFacebookCircleFill,
  RiTwitterXFill,
  RiLinkedinBoxFill,
  RiInstagramFill,
  RiYoutubeFill,
} from '@remixicon/vue'

const form = useForm({
  email: null,
})

const onSubmit = () => {
  form.submit('post', route('newsletter.sync.contact'), {
    preserveScroll: true,
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
  })
}
</script>

<template>
  <div class="bg-[#F3EDE5] py-8 lg:py-12">
    <div class="container">
      <div
        class="grid grid-cols-1 lg:grid-cols-5 divide-y lg:divide-y-0 lg:divide-x divide-[#E1CAB0]"
      >
        <div class="col-span-3 pb-12 lg:pb-0 lg:pr-12">
          <h2 id="newsletter-headline" class="text-2xl font-bold mb-4">
            Restez informé des actualités de l’engagement et des prochaines fresques autour de chez
            vous
          </h2>
          <form :aria-labelledby="`newsletter-headline`" class="" @submit.prevent="onSubmit">
            <div class="w-full gap-4 lg:gap-0 flex flex-col lg:flex-row">
              <Input
                name="email"
                type="email"
                v-model.trim="form.email"
                placeholder="Votre adresse électronique (ex. : nom@domaine.fr)"
                :error="!!form.errors.email"
                variant="white"
                custom-class="lg:rounded-tl"
              />
              <Button type="submit" :disabled="form.processing" class="lg:rounded-tr">
                S’abonner
              </Button>
            </div>
            <div class="text-[#ce0500] text-xs mt-2" v-if="form.errors.email">
              {{ form.errors.email }}
            </div>
          </form>

          <p class="text-xs text mt-4 text-[#666666]">
            En renseignant votre adresse électronique, vous acceptez de recevoir nos actualités par
            courriel. Vous pouvez vous désinscrire à tout moment à l’aide des liens de
            désinscription ou en nous contactant.
          </p>
        </div>

        <div class="col-span-2 pt-12 lg:pt-0 lg:pl-12">
          <h2 class="text-2xl font-bold mb-6">
            Suivez JeVeuxAider.gouv.fr sur les réseaux sociaux
          </h2>
          <div class="flex space-x-4 items-center -ml-2">
            <a
              href="https://www.facebook.com/jeveuxaider.gouv.fr/"
              target="_blank"
              title=""
              class="p-2 text-dsfr-blue hover:text-dsfr-blue-hover active:text-jva-blue-900"
            >
              <RiFacebookCircleFill size="24" class="fill-current" />
            </a>
            <a
              href="https://twitter.com/ReserveCivique"
              target="_blank"
              title=""
              class="p-2 text-dsfr-blue hover:text-dsfr-blue-hover active:text-jva-blue-900"
            >
              <RiTwitterXFill size="20" class="fill-current" />
            </a>
            <a
              href="https://www.linkedin.com/company/jeveuxaider-gouv-fr/?originalSubdomain=fr"
              target="_blank"
              title=""
              class="p-2 text-dsfr-blue hover:text-dsfr-blue-hover active:text-jva-blue-900"
            >
              <RiLinkedinBoxFill size="24" class="fill-current" />
            </a>
            <a
              href="https://www.instagram.com/jeveuxaider_gouv/?hl=fr"
              target="_blank"
              title=""
              class="p-2 text-dsfr-blue hover:text-dsfr-blue-hover active:text-jva-blue-900"
            >
              <RiInstagramFill size="24" class="fill-current" />
            </a>
            <a
              href="https://www.youtube.com/@jeveuxaider.gouv.fr1"
              target="_blank"
              title=""
              class="p-2 text-dsfr-blue hover:text-dsfr-blue-hover active:text-jva-blue-900"
            >
              <RiYoutubeFill size="24" class="fill-current" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<!-- <script>
import axios from 'axios'

export default defineNuxtComponent({
  data() {
    return {
      loading: false,
      error: '',
      success: '',
      form: {
        email: '',
      },
      socialMedias: [
        {
          name: 'Twitter',
          icon: 'RiTwitterFill',
          url: 'https://twitter.com/ReserveCivique',
        },
        {
          name: 'Linkedin',
          icon: 'RiLinkedinBoxFill',
          url: 'https://fr.linkedin.com/company/jeveuxaider-gouv-fr',
        },
        {
          name: 'Facebook',
          icon: 'RiFacebookCircleFill',
          url: 'https://fr-fr.facebook.com/jeveuxaider.gouv.fr/',
        },
        {
          name: 'Instagram',
          icon: 'RiInstagramFill',
          url: 'https://www.instagram.com/jeveuxaider_gouv/?hl=fr',
        },
      ],
    }
  },
})
</script> -->
