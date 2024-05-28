<script setup>
import { Link, Button } from '@/Components/Dsfr'
import { RiArrowRightLine } from '@remixicon/vue'
</script>

<template>
  <div class="border">
    <div class="p-10">
      <inline-svg
        :src="`${$page.props.assetUrl}/images/icons/gimmick.svg`"
        alt=""
        class="text-[#6B93F6] mb-4 rotate-[-100deg] focus:outline-none"
      />
      <h3 class="text-3xl mb-8 font-bold">Est-ce que c’est fait pour moi ?</h3>
      <div class="text-xl mb-8 space-y-4">
        <div class="flex">
          <img
            :src="`${$page.props.assetUrl}/images/icons/check.svg`"
            alt=""
            class="inline-block mr-4"
          />
          <div>Tu souhaites aider mais tu ne sais pas par où commencer ?</div>
        </div>
        <div class="flex">
          <img
            :src="`${$page.props.assetUrl}/images/icons/check.svg`"
            alt=""
            class="inline-block mr-4"
          />
          <div>Tu es curieux, timide, extraverti, pessimiste ou optimiste</div>
        </div>
        <div class="flex">
          <img
            :src="`${$page.props.assetUrl}/images/icons/check.svg`"
            alt=""
            class="inline-block mr-4"
          />
          <div>Tu as entre 16 et 99 ans</div>
        </div>
      </div>
      <div class="text-xl font-bold mb-8">
        Inscris-toi à la prochaine fresque près de chez toi !
      </div>
      <!-- <Link href="#">Plus d’infos <RiArrowRightLine size="18" class="inline" /> </Link> -->
    </div>
  </div>
</template>
