<script setup lang="jsx">
import { defineComponent, ref, computed } from 'vue'
import DsfrTag from '@/Components/Dsfr/Tag.vue'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import { RiTimeLine, RiCalendarEventLine } from '@remixicon/vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import MarkdownIt from 'markdown-it'
import { Head, Link, router } from '@inertiajs/vue3'

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const markdown = new MarkdownIt()
</script>

<template>
  <AppLayout title="Titre de la fresque">
    <div class="">
      <img
        :src="fresque.cover ? `/storage/${fresque.cover}` : '/images/default-placeholder.png'"
        alt="fresque"
        class="w-full h-[300px] object-cover"
      />
    </div>
    <div class="container py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="col-span-1 lg:col-span-2">
          <div v-if="fresque.summary" class="">
            <div class="markdown" v-html="markdown.render(fresque.summary)" />
          </div>
        </div>
        <div class="col-span-1">
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
      </div>
    </div>

    <div class="container py-12">
      <h2 class="text-2xl font-bold">A propos du lieu</h2>
      <div>
        <div>{{ fresque.place.name }}</div>
        <div>{{ fresque.place.full_address }}</div>
        <div>CARTE ?</div>
        <div
          v-if="fresque.place.summary"
          class="markdown"
          v-html="markdown.render(fresque.place.summary)"
        />
        <div class="flex gap-2">
          <div v-for="(photo, i) in fresque.place.photos" :key="i" class="w-[300px] h-[300px]">
            <img :src="`/storage/${photo}`" alt="" class="h-[300px] object-cover" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
