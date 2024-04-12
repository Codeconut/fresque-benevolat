<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'

const testimonials = [
  {
    logo: '/images/logos/protection-civile-logo.png',
    firstName: 'Véronique',
    benevoleLabel: 'bénévole auprès des personnes isolées chez la',
    organisationName: 'Protection Civile',
    text: 'Mon meilleur souvenir, c’était une petite dame de plus de 90 ans qui était dans sa jeunesse une chanteuse lyrique. Elle m’a raconté ses nombreuses rencontres artistiques. Je l’ai appelée plusieurs fois. N’hésitez pas à vous inscrire comme bénévoles, vous en sortirez grandi.',
  },
  {
    logo: '/images/logos/protection-civile-logo.png',
    firstName: 'Véronique',
    benevoleLabel: 'bénévole auprès des personnes isolées chez la',
    organisationName: 'Organisation 1',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui.',
  },
  {
    logo: '/images/logos/protection-civile-logo.png',
    firstName: 'Véronique',
    benevoleLabel: 'bénévole auprès des personnes isolées chez la',
    organisationName: 'Organisation 2',
    text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui.',
  },
]
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
          <Swiper :modules="[Pagination, A11y]" :pagination="{ clickable: true }">
            <SwiperSlide v-for="(testimonial, i) in testimonials" :key="i">
              <img src="/images/icons/quote.svg" alt="" class="h-8 w-8 flex-none mb-4" />
              <p class="mb-8 text-xl font-bold">
                {{ testimonial.text }}
              </p>
              <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-4">
                <img
                  :src="testimonial.logo"
                  :alt="testimonial.organisationName"
                  class="relative z-[3] flex-none h-[48px] w-[48px] lg:w-[60px] lg:h-[60px]"
                />
                <p class="text-[#666666] text-md lg:text-lg mt-4 lg:mt-0">
                  <strong>{{ testimonial.firstName }}</strong
                  >, {{ testimonial.benevoleLabel }}
                  <strong>{{ testimonial.organisationName }}</strong>
                </p>
              </div>
            </SwiperSlide>
          </Swiper>
        </div>
        <div class="overflow-hidden">
          <div
            class="w-0 h-0 border-t-[40px] border-t-transparent border-l-[1284px] border-l-dsfr-lavande border-b-[0px] border-b-transparent"
          ></div>
          <div class="bg-dsfr-lavande p-4">
            <div class="">
              <div class="flex flex-col lg:flex-row">
                <img
                  src="/images/testimonials/testimonial-1.png"
                  alt=""
                  class="w-full h-auto lg:h-[245px] lg:w-auto"
                />
                <img
                  src="/images/testimonials/testimonial-2.png"
                  alt=""
                  class="w-full h-auto lg:h-[245px] lg:w-auto"
                />
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

<style lang="postcss" scoped>
.swiper {
  :deep(.swiper-pagination) {
    @apply text-left relative mt-8;
    .swiper-pagination-bullet {
      @apply w-[10px] h-[10px];
      background-color: #e1cab0;
      &-active {
        background-color: #a38f78;
      }
    }
  }
}
</style>
