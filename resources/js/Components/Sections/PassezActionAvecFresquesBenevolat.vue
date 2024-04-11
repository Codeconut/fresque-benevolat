<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="relative">
    <img
      class="absolute top-[-100px] right-0"
      src="/images/illustrations/dashed-line-1.svg"
      alt=""
    />
    <!--  <img class="absolute bottom-0 left-0" src="/images/dashed-line-blue-gray.svg" alt="" /> -->
    <div class="container relative">
      <img
        class="absolute top-[370px] right-[50px] h-20 sm:top-[300px] sm:right-[50px] sm:h-24 lg:top-[100px] lg:right-[450px] lg:h-32"
        src="/images/icons/compas.svg"
        alt=""
      />
      <img
        class="hidden lg:block absolute lg:top-[0px] lg:right-[-50px] xl:top-[50px] xl:right-0 h-[275px] w-auto"
        src="/images/illustrations/hero-yellow.png"
        alt=""
      />
      <img
        class="hidden xl:block absolute lg:top-[200px] lg:right-[300px] xl:top-[200px] xl:right-[300px] h-[275px] w-auto"
        src="/images/illustrations/hero-blue.png"
        alt=""
      />
      <img
        class="hidden lg:block absolute lg:bottom-[100px] lg:right-0 xl:bottom-[50px] xl:right-0 h-[275px] w-auto"
        src="/images/illustrations/hero-green.png"
        alt=""
      />
      <div class="relative z-10 py-[60px] lg:py-[120px]">
        <div class="max-w-[629px]">
          <h1 class="font-bold text-5xl lg:text-[80px] lg:leading-[88px]">
            Passez à l’action avec la Fresque du Bénévolat
          </h1>
          <p class="text-2xl my-8">
            Participez à un atelier participatif de 2h30 top chrono et découvrez le bénévolat sous
            toutes ses formes
          </p>
          <Link :href="route('fresques.index')">
            <Button size="lg"
              >Trouver une fresque <span class="hidden lg:inline">près de chez moi</span></Button
            >
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
