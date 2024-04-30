<script setup>
import { Link } from '@inertiajs/vue3'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'
import { useSwiper } from 'swiper/vue'
import { ref } from 'vue'
import { RiArrowRightLine, RiArrowLeftLine } from '@remixicon/vue'
import { Button, IconButton } from '@/Components/Dsfr'

const testimonials = [
  {
    logo: '/images/logos/protection-civile-logo.png',
    firstName: 'Maryline',
    benevoleLabel: 'étudiante',
    text: 'J’ai adoré le moment où chacun devrait prendre une image et écrire un message, c’était un très fort de lire ce que les autres ont écrits et de voir à quels point on est différents mais tellement proches.',
  },
  {
    logo: '/images/logos/protection-civile-logo.png',
    firstName: 'Thomas',
    benevoleLabel: 'participant',
    text: 'J’ai bien aimé l’énergie qui en ressort, la motivation des animatrices. Comme première Fresque, c’était super riche et motivant !',
  },
]

const swiper = ref(null)

const onSwiper = (swiperInstance) => {
  swiper.value = swiperInstance
}
</script>

<template>
  <div class="relative pt-10 lg:py-20">
    <img
      class="absolute z-0 top-[200px] left-0"
      src="/images/illustrations/dashed-line-4.svg"
      alt=""
    />
    <img
      class="absolute top-[90px] right-[40px] lg:top-[50px] lg:right-[50px]"
      src="/images/icons/mountains.svg"
      alt=""
    />
    <div class="relative lg:container">
      <h2 class="px-4 lg:px-0 relative text-3xl lg:text-5xl lg:leading-[56px] font-bold mb-14">
        Ils ont participé et ont adoré
      </h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="px-4 lg:px-0 lg:pt-8">
          <div
            class="bg-white flex flex-col justify-between gap-8 border p-8 pb-0 lg:p-16 relative h-full"
          >
            <div class="h-full pb-8 lg:pb-0">
              <Swiper
                :modules="[Pagination, A11y]"
                :pagination="{ clickable: true }"
                @swiper="onSwiper"
                class="h-full"
              >
                <SwiperSlide v-for="(testimonial, i) in testimonials" :key="i">
                  <img src="/images/icons/quote.svg" alt="" class="h-8 w-8 flex-none mb-4" />
                  <p class="mb-8 text-xl font-bold">
                    {{ testimonial.text }}
                  </p>
                  <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-4">
                    <div
                      class="h-[40px] w-[40px] bg-[#E8EDFF] border-[#E3E3FD] rounded-full flex justify-center items-center"
                    >
                      <span class="relative top-[-1px]">😎</span>
                    </div>
                    <p class="text-[#666666] text-md lg:text-lg mt-4 lg:mt-0">
                      <strong>{{ testimonial.firstName }}</strong
                      >, {{ testimonial.benevoleLabel }}
                    </p>
                  </div>
                </SwiperSlide>
              </Swiper>
            </div>
            <div class="hidden lg:block absolute bottom-14 right-12 z-20">
              <div class="flex space-x-3 self-end">
                <IconButton
                  variant="custom"
                  @click="swiper.slidePrev()"
                  :icon="RiArrowLeftLine"
                  size="lg"
                  custom-class="border-dsfr-blue text-dsfr-blue hover:bg-white"
                />
                <IconButton
                  variant="custom"
                  @click="swiper.slideNext()"
                  :icon="RiArrowRightLine"
                  size="lg"
                  custom-class="border-dsfr-blue text-dsfr-blue hover:bg-white"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="overflow-hidden">
          <div class="bg-dsfr-lavande p-8 testimonials-clip-path">
            <div class="pt-8">
              <div class="flex flex-col lg:flex-row">
                <img
                  src="/images/testimonials/testimonial-1.png"
                  srcset="
                    /images/testimonials/testimonial-1.png 1x,
                    /images/testimonials/testimonial-1.png 2x
                  "
                  alt=""
                  class="w-full h-auto lg:w-1/2 lg:h-auto"
                />
                <img
                  src="/images/testimonials/testimonial-2.png"
                  srcset="
                    /images/testimonials/testimonial-2.png 1x,
                    /images/testimonials/testimonial-2.png 2x
                  "
                  alt=""
                  class="w-full h-auto lg:w-1/2 lg:h-auto"
                />
              </div>

              <img
                src="/images/testimonials/testimonial-3.png"
                srcset="
                  /images/testimonials/testimonial-3.png 1x,
                  /images/testimonials/testimonial-3.png 2x
                "
                alt=""
                class="col-span-2 w-full h-auto"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.swiper {
  :deep(.swiper-slide) {
    @apply pb-12;
  }
  :deep(.swiper-pagination) {
    @apply text-left;
    .swiper-pagination-bullet {
      @apply w-[10px] h-[10px] opacity-100;
      background-color: #bfccfb;
      &-active {
        background-color: #518fff;
      }
    }
  }
}
</style>
