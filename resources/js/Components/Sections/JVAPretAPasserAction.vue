<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="py-20">
    <div class="container">
      <div class="overflow-hidden">
        <div
          class="overflow-hidden w-0 h-0 border-t-[40px] border-t-transparent border-l-[1284px] border-l-dsfr-blue border-b-[0px] border-b-transparent"
        ></div>
        <div class="bg-dsfr-blue text-white">
          <div class="max-w-[780px] mx-auto">
            <div class="py-20 text-center">
              <img
                src="/images/logos/jeveuxaider-logo-white.png"
                alt=""
                width="297"
                height="48"
                class="mx-auto mb-12"
              />
              <h3 class="text-5xl mb-8 font-bold">Déjà prêt à passer à l’action ?</h3>
              <p class="text-2xl mb-8">
                <strong>Plus de 17 000 missions de bénévolat</strong> n’attendent que vous sur
                JeVeuxAider.gouv.fr
              </p>
              <a href="https://jeveuxaider.gouv.fr/missions-benevolat" target="_blank">
                <Button
                  variant="custom"
                  size="lg"
                  custom-class="text-white border-white hover:bg-dsfr-blue-hover"
                  >Trouver une mission de bénévolat</Button
                >
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
