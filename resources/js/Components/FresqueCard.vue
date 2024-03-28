<script setup lang="jsx">
import { defineComponent, defineProps, ref, withModifiers } from 'vue'
import DsfrTag from '@/Components/Dsfr/Tag.vue'
import { RiTimeLine, RiCalendarEventLine } from '@remixicon/vue'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="border flex bg-white">
    <div class="">
      <img
        :src="fresque.cover ? `/storage/${fresque.cover}` : '/images/default-placeholder.png'"
        alt="fresque"
        class="w-[300px] h-[200px] object-cover"
      />
    </div>
    <div class="p-4">
      <div class="mb-4 flex space-x-4">
        <DsfrTag :icon="RiCalendarEventLine">{{ fresque.date }}</DsfrTag>
        <DsfrTag :icon="RiTimeLine">{{ fresque.start_at }} {{ fresque.end_at }}</DsfrTag>
      </div>
      <h2 class="text-xl font-bold mb-4">{{ fresque.address.city }}</h2>
      <div class="text-sm">{{ fresque.address.full_address }}</div>
      <div class="text-sm" v-if="fresque.animators.length">
        Animé par {{ fresque.animators.map((item) => item.public_name).join(', ') }}
      </div>
      <div class="text-sm">{{ fresque.places_left }} places restantes</div>
    </div>
  </div>
</template>
