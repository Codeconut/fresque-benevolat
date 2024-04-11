<script setup lang="jsx">
import { defineComponent } from 'vue'
import DsfrTag from '@/Components/Dsfr/Tag.vue'
import {
  RiTimeLine,
  RiCalendarEventLine,
  RiMapPin2Fill,
  RiUserHeartFill,
  RiArrowRightLine,
} from '@remixicon/vue'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
  orientation: {
    type: String,
    default: 'horizontal',
  },
})
</script>

<template>
  <div
    :class="[
      'group border flex bg-white',
      { 'flex-row': orientation === 'horizontal' },
      { 'flex-col max-w-[384px] w-full': orientation === 'vertical' },
    ]"
  >
    <div class="">
      <img
        :src="fresque.cover ? `/storage/${fresque.cover}` : '/images/default-placeholder.png'"
        alt="fresque"
        :class="[
          'object-cover',
          { 'w-[264px] h-[244px] ': orientation === 'horizontal' },
          { 'w-[384px] h-[216px] ': orientation === 'vertical' },
        ]"
      />
    </div>
    <div
      :class="[
        'flex-1 relative ',
        { 'p-10': orientation === 'horizontal' },
        { 'p-8 ': orientation === 'vertical' },
      ]"
    >
      <div class="mb-6 flex space-x-4">
        <DsfrTag variant="unclickable" :icon="RiCalendarEventLine">{{
          $dayjs(fresque.date).format('DD MMMM YYYY')
        }}</DsfrTag>
        <DsfrTag variant="unclickable" :icon="RiTimeLine">{{ fresque.schedules }}</DsfrTag>
      </div>
      <h2 class="text-2xl font-bold mb-4 line-clamp-2 h-[70px]">
        {{ fresque.place.city }} - {{ fresque.place.name }}
      </h2>
      <div class="text-[#666666] text-sm">
        <div class="flex items-center mb-3">
          <RiMapPin2Fill size="16" class="mr-2" />
          <span class="line-clamp-1">{{ fresque.place.full_address }}</span>
        </div>
        <div class="flex items-center">
          <RiUserHeartFill size="16" class="mr-2" />
          <span class="line-clamp-1">{{ fresque.places_left }} places disponibles</span>
        </div>
      </div>
      <RiArrowRightLine
        size="32"
        class="text-dsfr-blue absolute bottom-6 right-6 group-hover:right-8 transition-all"
      />
    </div>
  </div>
</template>
