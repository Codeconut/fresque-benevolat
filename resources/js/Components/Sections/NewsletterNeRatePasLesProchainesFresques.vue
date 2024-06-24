<script setup>
import { Button, Input } from '@/Components/Dsfr'
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

const form = useForm({
  email: null,
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
  <div class="py-8 lg:py-12">
    <div class="">
      <div class="relative bg-white border p-8 lg:p-12">
        <inline-svg
          :src="`${$page.props.assetUrl}/images/icons/gimmick.svg`"
          alt=""
          class="text-[#FCD17B] hidden lg:block focus:outline-none fill-current w-[45px] lg:w-[65px] !max-w-[71px] rotate-[-120deg] absolute top-[-40px] left-[-40px] lg:top-[-52px] lg:left-[-55px]"
        />
        <h2 id="newsletter-headline" class="text-2xl font-bold mb-4">
          Ne rate pas les prochaines fresques
        </h2>
        <p class="text-[#666666] text-lg mb-4">
          Tu recevras un email lorsqu’une nouvelle fresque sera publiée
        </p>
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
              custom-class="lg:rounded-tl"
            />
            <Button type="submit" :disabled="form.processing" class="lg:rounded-tr">
              Je veux être averti
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
          courriel. Tu peux te désinscrire à tout moment à l’aide des liens de désinscription ou en
          nous contactant.
        </p>
      </div>
    </div>
  </div>
</template>
