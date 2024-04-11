<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="relative py-20">
    <img
      class="absolute z-0 top-[200px] left-0"
      src="/images/illustrations/dashed-line-4.svg"
      alt=""
    />
    <div class="relative container">
      <h2 class="relative text-4xl lg:text-5xl leading-[56px] font-bold mb-14">
        Ils ont participé et ont adoré
      </h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white border p-8 lg:p-16">
          <img src="/images/icons/quote.svg" alt="" class="h-8 w-8 flex-none mb-4" />
          <p class="mb-8 text-xl font-bold">
            Mon meilleur souvenir, c’était une petite damede plus de 90 ans qui était dans sa
            jeunesse une chanteuse lyrique. Elle m’a raconté ses nombreuses rencontres artistiques.
            Je l’ai appelée plusieurs fois. N’hésitez pas à vous inscrire comme bénévoles, vous en
            sortirez grandi.
          </p>
          <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-4">
            <img
              src="/images/logos/protection-civile-logo.png"
              alt="Timothée"
              class="relative z-[3] flex-none h-[48px] w-[48px] lg:w-[60px] lg:h-[60px]"
            />
            <p class="text-[#666666] text-md lg:text-lg mt-4 lg:mt-0">
              <strong>Véronique</strong>, bénévole auprès des personnes isolées chez la
              <strong>Protection Civile</strong>
            </p>
          </div>
        </div>
        <div class="overflow-hidden">
          <div
            class="w-0 h-0 border-t-[40px] border-t-transparent border-l-[1284px] border-l-dsfr-lavande border-b-[0px] border-b-transparent"
          ></div>
          <div class="bg-dsfr-lavande p-4">
            <div class="">
              <div class="flex flex-col lg:flex-row">
                <img src="/images/testimonials/testimonial-1.png" alt="" class="h-[245px] w-auto" />
                <img src="/images/testimonials/testimonial-2.png" alt="" class="h-[245px] w-auto" />
              </div>

              <img src="/images/testimonials/testimonial-3.png" alt="" class="col-span-2" />
            </div>
          </div>
          <div
            class="w-0 h-0 border-b-[30px] border-b-transparent border-l-[1284px] border-l-dsfr-lavande border-t-[0px] border-t-transparent"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>
