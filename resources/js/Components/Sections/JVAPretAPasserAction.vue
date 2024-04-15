<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="py-20">
    <div class="container">
      <div class="relative">
        <!-- <div
          class="bg-dsfr-blue rounded-t-3xl w-full h-[80px] skew-y-[1deg] absolute top-[-35px] left-0"
        ></div> -->
        <!-- <div
          class="overflow-hidden w-[30px] h-[30px] border-t-[60px] rounded-tl-3xl rounded-tr-3xl border-t-transparent border-l-[1284px] border-l-dsfr-blue border-b-[0px] border-b-transparent"
        ></div> -->
        <div class="bg-dsfr-blue text-white jva-clip-path rounded-3xl">
          <div class="max-w-[780px] mx-auto">
            <div class="py-20 px-8 text-center">
              <img
                src="/images/logos/jeveuxaider-logo-white.png"
                alt=""
                width="297"
                height="48"
                class="mx-auto mb-12"
              />
              <h3 class="text-4xl lg:text-5xl mb-8 font-bold">Déjà prêt à passer à l’action ?</h3>
              <p class="text-2xl mb-8">
                <strong>Plus de 17 000 missions de bénévolat</strong> n’attendent que vous sur
                JeVeuxAider.gouv.fr
              </p>
              <a href="https://jeveuxaider.gouv.fr/missions-benevolat" target="_blank">
                <Button
                  variant="custom"
                  size="lg"
                  custom-class="text-white border-white hover:bg-dsfr-blue-hover"
                  >Trouver une mission <span class="hidden lg:inline">de bénévolat</span></Button
                >
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
