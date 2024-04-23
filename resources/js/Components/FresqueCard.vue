<script setup>
import { Tag } from '@/Components/Dsfr'
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
      'group border flex bg-white hover:shadow-xl transition-all p-4',
      { 'flex-col sm:flex-row': orientation === 'horizontal' },
      { 'flex-col w-[384px]': orientation === 'vertical' },
    ]"
  >
    <div
      :class="[
        'max-w-full',
        { 'w-[395px] h-[216px] sm:w-[264px] sm:h-[196px]': orientation === 'horizontal' },
        { 'w-[384px] h-[216px] ': orientation === 'vertical' },
      ]"
    >
      <img
        :src="fresque.default_picture ? fresque.default_picture : '/images/default-placeholder.png'"
        alt="fresque"
        :class="['object-cover w-full h-full']"
      />
    </div>
    <div
      :class="[
        'flex-1 relative',
        { 'px-8 py-4 h-full': orientation === 'horizontal' },
        { 'py-8 px-4': orientation === 'vertical' },
      ]"
    >
      <div class="mb-6 flex gap-2">
        <Tag variant="custom" :icon="RiCalendarEventLine">{{
          $dayjs(fresque.date).format('DD MMMM YYYY')
        }}</Tag>
        <Tag variant="custom" :icon="RiTimeLine">{{ fresque.schedules }}</Tag>
      </div>
      <h2
        :class="[
          'text-2xl font-bold mb-4',
          { 'line-clamp-1': orientation === 'horizontal' },
          { 'line-clamp-2': orientation === 'vertical' },
        ]"
        :title="`${fresque.place.city} - ${fresque.place.name}`"
      >
        <template v-if="orientation === 'horizontal'">
          {{ fresque.place.city }} -
          {{ fresque.place.name }}
        </template>
        <template v-else>
          {{ fresque.place.city }}<br />
          {{ fresque.place.name }}
        </template>
      </h2>
      <div class="text-[#666666] text-sm mb-auto">
        <div class="flex items-center mb-3">
          <RiMapPin2Fill size="16" class="mr-2 text-[#6A6156]" />
          <span class="line-clamp-1">{{ fresque.place.full_address }}</span>
        </div>
        <div class="flex items-center">
          <RiUserHeartFill size="16" class="mr-2 text-[#6A6156]" />
          <span class="line-clamp-1">{{
            $filters.pluralize(fresque.places_left, 'place disponible', 'places disponibles')
          }}</span>
        </div>
      </div>
      <RiArrowRightLine
        v-if="orientation === 'horizontal'"
        size="32"
        class="text-dsfr-blue absolute bottom-0 right-6 group-hover:right-8 transition-all"
      />
    </div>
  </div>
</template>
