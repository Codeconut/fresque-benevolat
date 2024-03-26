<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="bg-blue-france-sun-113 text-white relative overflow-hidden">
    <img class="absolute top-0 right-0" src="/images/dashed-line-pink.svg" alt="" />
    <img class="absolute bottom-0 left-0" src="/images/dashed-line-blue-gray.svg" alt="" />
    <div class="container relative">
      <img
        class="absolute bottom-0 h-[698px] w-[698px] right-0"
        src="/images/mascotte.svg"
        alt=""
      />
      <div class="py-[120px]">
        <div class="max-w-[629px]">
          <h1 class="font-bold text-[80px] leading-[88px]">
            Passez à l’action avec la Fresque du Bénévolat
          </h1>
          <p class="text-2xl my-8">
            Participez à un atelier participatif de 2h30 top chrono et découvrez le bénévolat sous
            toutes ses formes
          </p>
          <Link :href="route('fresques-benevolat')">
            <Button variant="secondary" size="lg">Trouver une fresque près de chez moi</Button>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
