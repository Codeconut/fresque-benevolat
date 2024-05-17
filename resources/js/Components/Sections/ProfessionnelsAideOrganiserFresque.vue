<script setup>
import { Button } from '@/Components/Dsfr'
</script>

<template>
  <div class="py-10 lg:py-20">
    <div class="">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="relative text-4xl lg:text-5xl lg:leading-[56px] font-bold mb-14">
          <span class="relative">
            <img
              v-svg-inline
              :src="`${$page.props.assetUrl}/images/icons/gimmick.svg`"
              alt=""
              class="text-[#77EDA5] focus:outline-none fill-current w-[45px] lg:w-[65px] !max-w-[71px] rotate-[-100deg] absolute top-[-35px] left-[-40px] lg:top-[-30px] lg:left-[-43px]"
            /> </span
          >Ça fresque <br />
          dans les organisations !
        </h2>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border p-8 lg:p-16">
          <div class="flex flex-col lg:flex-row lg:items-center mb-10">
            <img
              :src="`${$page.props.assetUrl}/images/icons/school.svg`"
              alt=""
              class="h-[80px] w-[80px] flex-none mr-6"
            />
            <h3 class="text-3xl font-bold">Écoles <br class="hidden lg:block" />et entreprises</h3>
          </div>
          <p class="mb-10 text-xl">
            Sensibilisez vos étudiants et employés au bénévolat grâce à la Fresque
          </p>
          <a target="_blank" href="https://tally.so/r/mDVR2j">
            <Button size="lg" class="mb-10">Nous contacter</Button>
          </a>
          <div class="flex items-center space-x-4">
            <div class="flex flex-shrink-0">
              <img
                :src="`${$page.props.assetUrl}/images/team/timothee.jpg`"
                alt="Timothée"
                class="relative z-[3] flex-none h-[48px] w-[48px] lg:w-[60px] lg:h-[60px]"
              />
            </div>
            <p class="text-[#666666] !-mr-1 xs:!mr-0 xl:text-lg">
              <strong>Timothée</strong> de JeVeuxAider.gouv.fr <br class="hidden lg:block" />
              vous accompagne
            </p>
          </div>
        </div>
        <div class="bg-white border p-8 lg:p-16">
          <div class="flex flex-col lg:flex-row lg:items-center mb-10">
            <img
              :src="`${$page.props.assetUrl}/images/icons/human-cooperation.svg`"
              alt=""
              class="h-[80px] w-[80px] flex-none mr-6"
            />
            <h3 class="text-3xl font-bold">Associations et organisations publiques</h3>
          </div>
          <p class="mb-10 text-xl">
            Faites connaître votre cause et mettez en valeur l’engagement grâce à la Fresque du
            Bénévolat
          </p>
          <a target="_blank" href="https://tally.so/r/wg5QDN">
            <Button size="lg" class="mb-10">Nous contacter</Button>
          </a>
          <div class="flex items-center space-x-4">
            <div class="flex flex-shrink-0">
              <img
                :src="`${$page.props.assetUrl}/images/team/nivine.jpg`"
                alt="Nivine"
                class="relative z-[3] flex-none h-[48px] w-[48px] lg:w-[60px] lg:h-[60px]"
              />
            </div>
            <p class="text-[#666666] !-mr-1 xs:!mr-0 xl:text-lg">
              <strong>Nivine</strong> de JeVeuxAider.gouv.fr <br class="hidden lg:block" />
              vous accompagne
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
