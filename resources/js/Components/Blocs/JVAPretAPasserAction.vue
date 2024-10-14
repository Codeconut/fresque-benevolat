<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
import { RiArrowRightLine } from '@remixicon/vue'
</script>

<template>
  <div class="rounded-3xl bg-[#F5F5FE]">
    <div class="border-8 border-white rounded-3xl">
      <a href="https://jeveuxaider.gouv.fr/missions-benevolat" target="_blank" class="group">
        <div class="overflow-hidden">
          <div class="">
            <div class="max-w-[780px] mx-auto">
              <div class="px-10 pt-12 pb-16 relative">
                <h3 class="text-[28px] mb-8 font-bold">Déjà prêt à passer <br />à l’action ?</h3>
                <p class="text-lg mb-8">
                  Plus de 18 000 missions de bénévolat n’attendent que toi sur JeVeuxAider.gouv.fr
                </p>
                <img
                  :src="`${$page.props.assetUrl}/images/logos/jeveuxaider-logo.svg`"
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
        </div>
      </a>
    </div>
  </div>
</template>
