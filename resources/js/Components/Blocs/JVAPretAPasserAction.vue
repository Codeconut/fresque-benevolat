<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
import { RiArrowRightLine } from '@remixicon/vue'
</script>

<template>
  <div>
    <a href="https://jeveuxaider.gouv.fr/missions-benevolat" target="_blank" class="group">
      <div class="overflow-hidden">
        <!-- <div
          class="overflow-hidden w-0 h-0 border-t-[15px] border-t-transparent border-l-[1000px] border-l-dsfr-blue border-b-[0px] border-b-transparent"
        ></div> -->
        <div class="bg-dsfr-blue jva-blue-clip-path text-white">
          <div class="max-w-[780px] mx-auto">
            <div class="px-10 pt-12 pb-16 relative">
              <h3 class="text-3xl mb-8 font-bold">Déjà prêt à passer <br />à l’action ?</h3>
              <p class="text-xl mb-8">
                Plus de 18 000 missions de bénévolat n’attendent que vous sur JeVeuxAider.gouv.fr
              </p>
              <img
                src="/images/logos/jeveuxaider-logo-white.png"
                alt=""
                width="222"
                height="36"
                class=""
              />
              <RiArrowRightLine
                size="32"
                class="absolute bottom-6 right-6 group-hover:right-7 transition-all"
              />
            </div>
          </div>
        </div>
        <!-- <div
          class="overflow-hidden w-0 h-0 border-b-[10px] border-b-transparent border-r-[1000px] border-r-dsfr-blue border-t-[0px] border-t-transparent"
        ></div> -->
      </div>
    </a>
  </div>
</template>
