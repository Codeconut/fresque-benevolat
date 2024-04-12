<script setup>
import MarkdownIt from 'markdown-it'
import DsfrTag from '@/Components/Dsfr/Tag.vue'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import { RiTimeLine, RiCalendarEventLine } from '@remixicon/vue'
import { Head, Link, router } from '@inertiajs/vue3'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const markdown = new MarkdownIt()
</script>

<template>
  <div class="bg-white p-10 sticky top-12 mt-12">
    <div class="mb-4 flex space-x-4">
      <DsfrTag :icon="RiCalendarEventLine">{{
        $dayjs(fresque.date).format('DD MMMM YYYY')
      }}</DsfrTag>
      <DsfrTag :icon="RiTimeLine">{{ fresque.schedules }}</DsfrTag>
    </div>
    <h2 class="text-xl font-bold mb-4">{{ fresque.place.city }}</h2>
    <div class="">{{ fresque.place.full_address }}</div>
    <div class="" v-if="fresque.animators.length">
      Animé par {{ fresque.animators.map((item) => item.public_name).join(', ') }}
    </div>

    <template v-if="fresque.can_candidate">
      <div class="">{{ fresque.places_left }} places restantes</div>

      <Link :href="route('fresques.candidate', { fresque })">
        <DsfrButton> Je m'inscris</DsfrButton>
      </Link>
    </template>
    <template v-else>
      <div class="">Les inscriptions sont closes</div>
    </template>
  </div>
</template>
