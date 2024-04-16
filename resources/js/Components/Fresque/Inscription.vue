<script setup>
import MarkdownIt from 'markdown-it'
import DsfrTag from '@/Components/Dsfr/Tag.vue'
import DsfrButton from '@/Components/Dsfr/Button.vue'
import { RiCalendarEventLine, RiMapPin2Fill, RiUserHeartLine } from '@remixicon/vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { defineComponent, ref, computed } from 'vue'

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const markdown = new MarkdownIt()
const placesOccupied = computed(() => props.fresque.places - props.fresque.places_left)
</script>

<template>
  <div class="bg-white p-10 shadow-lg lg:sticky lg:top-10 lg:mt-10">
    <div class="grid gap-6">
      <div class="flex space-x-4">
        <RiCalendarEventLine size="20" class="text-[#518FFF] mt-[6px] flex-none" />
        <div>
          <div class="text-lg font-bold">{{ $dayjs(fresque.date).format('DD MMMM YYYY') }}</div>
          <div class="text-lg text-[#666666]">de {{ fresque.schedules }}</div>
        </div>
      </div>
      <div class="flex space-x-4">
        <RiMapPin2Fill size="20" class="text-[#518FFF] mt-[6px] flex-none" />
        <div>
          <div class="text-lg font-bold">{{ fresque.place.name }}</div>
          <div class="text-lg text-[#666666]">{{ fresque.place.full_address }}</div>
        </div>
      </div>
      <div class="flex space-x-4">
        <RiUserHeartLine size="20" class="text-[#518FFF] mt-[6px] flex-none" />
        <div>
          <div class="text-lg font-bold">
            {{ $filters.pluralize(fresque.places_left, 'place disponible', 'places disponibles') }}
          </div>
          <div class="text-lg text-[#666666]">
            {{
              $filters.pluralize(
                placesOccupied,
                'personne déjà inscrite',
                'personnes déjà inscrites'
              )
            }}
          </div>
        </div>
      </div>
      <div>
        <Link v-if="fresque.can_candidate" :href="route('fresques.candidate', { fresque })">
          <DsfrButton full size="lg"> Je m'inscris</DsfrButton>
        </Link>
        <DsfrButton v-else full disabled size="lg"> Inscriptions fermées</DsfrButton>
      </div>
    </div>
  </div>
</template>
