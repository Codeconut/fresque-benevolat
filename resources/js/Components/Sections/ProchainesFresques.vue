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
  <div class="py-20">
    <div class="container">
      <div class="flex justify-between items-center mb-16">
        <div class="flex space-x-3">
          <img src="/images/icons/megaphone.svg" alt="megaphone" class="" />
          <div>
            <h2 class="relative text-4xl lg:text-5xl leading-[56px] font-bold mb-4">
              Les prochaines fresques
            </h2>
            <div class="text-2xl text-[#666666]">
              Trouvez la prochaine fresque du bénévolat près de chez vous
            </div>
          </div>
        </div>
        <div class="flex flex-wrap justify-end gap-4">
          <IconButton
            variant="secondary"
            @click="swiper.slidePrev()"
            :icon="RiArrowLeftLine"
            size="lg"
          />
          <IconButton
            variant="secondary"
            @click="swiper.slideNext()"
            :icon="RiArrowRightLine"
            size="lg"
          />
          <Link :href="route('fresques.index')">
            <Button variant="secondary" size="lg">Toutes les fresques</Button>
          </Link>
        </div>
      </div>
      <div class="">
        <Swiper
          @swiper="onSwiper"
          :modules="[Pagination]"
          :slides-per-view="3"
          :loop="true"
          :space-between="24"
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
