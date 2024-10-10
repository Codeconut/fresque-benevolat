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
import { ref } from 'vue'

const form = useForm({
  email: null,
  type: 'contact',
})

const isSubscribed = ref(false)

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
      form.reset()
      isSubscribed.value = true
    },
    onFinish: () => {
      form.processing = false
    },
  })
}
</script>

<template>
  <div class="relative z-10 py-8 lg:py-12">
    <div class="container">
      <div
        class="grid grid-cols-1 lg:grid-cols-5 divide-y lg:divide-y-0 lg:divide-x divide-[#BFCCFB]"
      >
        <div class="col-span-3 pb-12 lg:pb-0 lg:pr-12">
          <h2 id="newsletter-headline" class="text-2xl font-bold mb-4">
            Reste informé des actualités de l’engagement et des prochaines fresques autour de chez
            toi
          </h2>
          <form :aria-labelledby="`newsletter-headline`" class="" @submit.prevent="onSubmit">
            <div class="w-full gap-4 lg:gap-0 flex flex-col lg:flex-row">
              <Input
                name="email"
                type="email"
                v-model.trim="form.email"
                :placeholder="
                  isSubscribed
                    ? 'Tu es inscrit à la newsletter :)'
                    : 'Ton adresse électronique (ex. : nom@domaine.fr)'
                "
                :error="!!form.errors.email"
                :success="isSubscribed"
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
            <!-- <div v-if="isSubscribed" class="text-[#18753c] text-xs mt-2">
              Tu es inscrit à la newsletter :)
            </div> -->
          </form>

          <p class="text-xs text mt-4 text-[#666666]">
            En renseignant ton adresse électronique, tu acceptes de recevoir nos actualités par
            courriel. Tu peux te désinscrire à tout moment à l’aide des liens de désinscription ou
            en nous contactant.
          </p>
        </div>

        <div class="col-span-2 pt-12 lg:pt-0 lg:pl-12">
          <h2 class="text-2xl font-bold mb-6">Suis JeVeuxAider.gouv.fr sur les réseaux sociaux</h2>
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
