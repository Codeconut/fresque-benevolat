<script setup>
import { Button } from '@/Components/Dsfr'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="relative py-10 lg:py-20">
    <img
      class="absolute z-0 top-[100px] right-0"
      :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-5.svg`"
      alt=""
    />
    <div class="relative container">
      <div class="mb-14">
        <h2 class="relative inline text-4xl lg:text-5xl lg:leading-[56px] font-bold">
          Deviens animateur
          <inline-svg
            :src="`${$page.props.assetUrl}/images/icons/gimmick.svg`"
            alt=""
            class="text-[#6B93F6] absolute w-[45px] h-auto top-[-20px] right-[-45px] lg:w-[65px] lg:h-[75px] lg:top-[-18px] lg:right-[-60px] focus:outline-none"
          />
        </h2>
        <div class="text-xl lg:text-2xl text-[#666666] mt-4">
          On te donne tous les outils pour animer toi-même des fresques du bénévolat
        </div>
      </div>
      <div class="flex flex-col divide-y-[#DDDDDD]">
        <div class="flex flex-col lg:flex-row gap-4 py-8">
          <div class="text-3xl font-bold lg:w-[376px]">Sensibilise</div>
          <div class="text-xl flex-1">
            Deviens acteur du bénévolat près de chez toi en explorant les bienfaits du bénévolat
            pour soi, pour les autres, et pour la société dans son ensemble
          </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-4 py-8">
          <div class="text-3xl font-bold lg:w-[376px]">Lève les freins</div>
          <div class="text-xl flex-1">
            Aide les participants à se reconnecter avec leurs engagements, valeurs, attentes,
            peurs... Et forme-toi à l'animation et aux outils d'intelligence collective, avec style
            et panache !
          </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-4 py-8">
          <div class="text-3xl font-bold lg:w-[376px]">Inspire</div>
          <div class="text-xl flex-1">
            Tu es convaincu que les besoins des associations doivent rencontrer la mobilisation
            citoyenne ? Donne envie aux participants de sauter le pas du bénévolat. On n’est pas là
            pour enfiler des perles !
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
