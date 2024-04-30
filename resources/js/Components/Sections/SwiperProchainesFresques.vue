<script setup>
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link } from '@inertiajs/vue3'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper/modules'
import { useSwiper } from 'swiper/vue'
import { ref } from 'vue'
import { Button, IconButton } from '@/Components/Dsfr'
import { RiArrowRightLine, RiArrowLeftLine } from '@remixicon/vue'

import 'swiper/css'
// import 'swiper/css/navigation'
import 'swiper/css/pagination'

const props = defineProps({
  fresques: {
    type: Array,
    default: () => [],
  },
})

const swiper = ref(null)

const onSwiper = (swiperInstance) => {
  swiper.value = swiperInstance
}
</script>

<template>
  <div class="py-10 lg:py-20">
    <div class="container">
      <div class="flex justify-between items-center mb-16">
        <div class="flex space-x-3">
          <img src="/images/icons/lunette.svg" alt="megaphone" class="hidden lg:block" />
          <div>
            <h2 class="relative text-4xl lg:text-5xl lg:leading-[56px] font-bold mb-4">
              Les prochaines fresques
            </h2>
            <div class="text-xl lg:text-2xl text-[#666666]">
              Trouve la prochaine fresque du bénévolat près de chez toi
            </div>
          </div>
        </div>
        <div class="hidden lg:flex flex-wrap justify-end gap-2">
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
          <Link :href="route('fresques.index')">
            <Button
              variant="custom"
              size="lg"
              custom-class="border-dsfr-blue text-dsfr-blue hover:bg-white"
              >Toutes les fresques</Button
            >
          </Link>
        </div>
      </div>
    </div>

    <div class="overflow-x-hidden">
      <div class="container">
        <Swiper
          @swiper="onSwiper"
          :modules="[Pagination, A11y]"
          :breakpoints="{
            '320': {
              slidesPerView: 1,
              spaceBetween: 24,
            },
            '768': {
              slidesPerView: 2,
              spaceBetween: 24,
            },
            '1024': {
              slidesPerView: 3,
              spaceBetween: 24,
            },
          }"
          :pagination="{ clickable: true }"
        >
          <SwiperSlide v-for="fresque in fresques" :key="fresque.id">
            <Link :href="route('fresques.show', { fresque: fresque.slug })">
              <FresqueCard class="" :fresque="fresque" orientation="vertical" />
            </Link>
          </SwiperSlide>
        </Swiper>
      </div>
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.swiper {
  @apply overflow-visible;
  :deep(.swiper-slide) {
    @apply !w-full !max-w-[384px];
  }
  :deep(.swiper-pagination) {
    @apply text-left relative mt-8;
    .swiper-pagination-bullet {
      @apply w-[10px] h-[10px] opacity-100;
      background-color: #e1cab0;
      &-active {
        background-color: #a38f78;
      }
    }
  }
}
</style>
