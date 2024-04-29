<script setup>
import { Button } from '@/Components/Dsfr'
import { Link } from '@inertiajs/vue3'
// import gimmickUrl from '@/assets/images/icons/gimmick.svg'
</script>

<template>
  <div class="relative py-10 lg:py-20">
    <img
      class="absolute z-0 top-[100px] right-0"
      src="/images/illustrations/dashed-line-5.svg"
      alt=""
    />
    <div class="relative container">
      <div class="mb-14">
        <h2 class="relative inline text-4xl lg:text-5xl lg:leading-[56px] font-bold">
          Devenez animateur
          <img
            v-svg-inline
            src="/images/icons/gimmick.svg"
            alt=""
            class="text-[#6B93F6] absolute w-[45px] h-auto top-[-20px] right-[-45px] lg:w-[65px] lg:h-[75px] lg:top-[-18px] lg:right-[-60px] focus:outline-none"
          />
        </h2>
        <div class="text-xl lg:text-2xl text-[#666666] mt-4">
          On vous donne tous les outils pour animer vous-même des fresques du bénévolat
        </div>
      </div>
      <div class="flex flex-col divide-y">
        <div class="flex flex-col lg:flex-row gap-4 py-8">
          <div class="text-3xl font-bold lg:w-[376px]">Sensibilisez</div>
          <div class="text-xl flex-1">
            Soyez acteur du bénévolat près de chez vous en parlant du bénévolat et de ses bienfaits
          </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-4 py-8">
          <div class="text-3xl font-bold lg:w-[376px]">Levez les freins</div>
          <div class="text-xl flex-1">
            Donnez le petit coup de pouce à ceux qui hésiteraient à sauter le pas du bénévolat
          </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-4 py-8">
          <div class="text-3xl font-bold lg:w-[376px]">Inspirez</div>
          <div class="text-xl flex-1">
            Animez des moments de convivialité pour tout type de public !
          </div>
        </div>
      </div>
      <div class="mt-8">
        <a
          href="https://www.jeveuxaider.gouv.fr/missions-benevolat?structure.name=JeVeuxAider.gouv.fr"
          target="_blank"
        >
          <Button
            variant="custom"
            size="lg"
            custom-class="bg-transparent text-dsfr-blue border-dsfr-blue hover:bg-white"
            >Devenir animateur</Button
          >
        </a>
      </div>
    </div>
  </div>
</template>
