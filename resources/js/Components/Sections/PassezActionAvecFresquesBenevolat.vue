<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="relative">
    <img
      class="absolute top-[-130px] lg:top-[-100px] right-0"
      :src="`${$page.props.assetUrl}/images//illustrations/dashed-line-1.svg`"
      alt=""
    />
    <img
      class="absolute top-[370px] right-[50px] sm:top-[300px] sm:right-[50px] lg:top-[50px] lg:right-[50px]"
      :src="`${$page.props.assetUrl}/images//icons/heart.svg`"
      alt=""
    />
    <div class="container relative">
      <div class="relative z-10 py-[48px] lg:py-[120px]">
        <div class="max-w-[685px]">
          <h1 class="font-bold text-[40px] leading-[48px] lg:text-[70px] lg:leading-[78px]">
            LA fresque qui t'amène du point A au point Bénévolat !
          </h1>
          <p class="text-[22px] lg:text-2xl my-8">
            En 2h30 d'atelier collectif prépare-toi à mettre ton énergie au service des grandes
            causes et à découvrir le bénévolat sous toutes ses formes.
          </p>
          <Link :href="route('fresques.index')">
            <Button size="lg"
              >Trouver une fresque <span class="hidden lg:inline">à deux pas</span></Button
            >
          </Link>
        </div>
      </div>
      <img
        class="w-[578px] h-auto lg:relative lg:mx-auto xl:absolute xl:top-[30px] xl:right-0"
        :src="`${$page.props.assetUrl}/images//illustrations/playcards.png`"
        alt=""
      />
    </div>
  </div>
</template>
