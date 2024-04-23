<script setup>
import { Link, Button } from '@/Components/Dsfr'
import { RiArrowRightLine } from '@remixicon/vue'
</script>

<template>
  <div class="border">
    <div class="p-10">
      <img
        v-svg-inline
        src="/images/icons/gimmick.svg"
        alt=""
        class="text-[#6B93F6] mb-4 rotate-[-100deg] focus:outline-none"
      />
      <h3 class="text-3xl mb-8 font-bold">Est-ce que c’est fait pour moi ?</h3>
      <div class="text-xl mb-8 space-y-4">
        <div class="flex">
          <img src="/images/icons/check.svg" alt="" class="inline-block mr-4" />
          <div>Vous hésitez à sauter le pas du bénévolat</div>
        </div>
        <div class="flex">
          <img src="/images/icons/check.svg" alt="" class="inline-block mr-4" />
          <div>Vous voulez apprendre plein de choses en vous amusant</div>
        </div>
        <div class="flex">
          <img src="/images/icons/check.svg" alt="" class="inline-block mr-4" />
          <div>Ou vous voulez devenir animateur de la fresque</div>
        </div>
      </div>
      <div class="text-xl font-bold mb-8">
        Inscrivez-vous à la prochaine fresque près de chez vous !
      </div>
      <!-- <Link href="#">Plus d’infos <RiArrowRightLine size="18" class="inline" /> </Link> -->
    </div>
  </div>
</template>
