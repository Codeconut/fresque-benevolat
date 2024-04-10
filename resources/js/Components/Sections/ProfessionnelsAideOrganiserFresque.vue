<script setup>
import { Button } from '@/Components/Dsfr'
</script>

<template>
  <div class="py-24">
    <div class="container">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="relative text-5xl leading-[56px] font-bold mb-14">
          Professionnels, on vous aide à organiser des fresques
          <img
            src="/images/icons/gimmick.svg"
            alt=""
            class="absolute top-0 left-0 -mt-[30px] -ml-[15px]"
          />
        </h2>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow-lg p-16">
          <div class="flex items-center mb-10">
            <img src="/images/icons/school.svg" alt="" class="h-[80px] w-[80px] flex-none mr-6" />
            <h3 class="text-3xl font-bold">Écoles <br class="hidden lg:block" />et entreprises</h3>
          </div>
          <p class="mb-10 text-xl">
            Sensibilisez vos étudiants et employés au bénévolat grâce à la Fresque
          </p>
          <Button class="mb-10">Nous contacter</Button>
          <div class="flex items-center space-x-4">
            <div class="flex flex-shrink-0">
              <img
                src="/images/team/timothee.jpg"
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
        <div class="bg-white shadow-lg p-16">
          <div class="flex items-center mb-10">
            <img
              src="/images/icons/human-cooperation.svg"
              alt=""
              class="h-[80px] w-[80px] flex-none mr-6"
            />
            <h3 class="text-3xl font-bold">Associations et organisations publiques</h3>
          </div>
          <p class="mb-10 text-xl">
            Faites connaître votre cause et mettez en avant l’engagement grâce à la Fresque du
            Bénévolat
          </p>
          <Button class="mb-10">Nous contacter</Button>
          <div class="flex items-center space-x-4">
            <div class="flex flex-shrink-0">
              <img
                src="/images/team/nivine.jpg"
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
