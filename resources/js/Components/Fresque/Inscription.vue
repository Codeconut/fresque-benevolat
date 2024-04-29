<script setup>
import MarkdownIt from 'markdown-it'
import { Button } from '@/Components/Dsfr'
import { RiCalendarEventFill, RiMapPin2Fill, RiUserHeartFill } from '@remixicon/vue'
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
  <div class="">
    <div class="bg-white p-10 shadow-lg lg:sticky lg:top-10 lg:mt-10">
      <div class="grid gap-6">
        <div class="flex space-x-4">
          <RiCalendarEventFill size="20" class="text-[#518FFF] mt-[6px] flex-none" />
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
          <RiUserHeartFill size="20" class="text-[#518FFF] mt-[6px] flex-none" />
          <div>
            <div class="text-lg font-bold">
              {{
                $filters.pluralize(fresque.places_left, 'place disponible', 'places disponibles')
              }}
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
        <div class="hidden lg:block">
          <Link v-if="fresque.can_candidate" :href="route('fresques.candidate', { fresque })">
            <Button full size="lg"> Je m'inscris</Button>
          </Link>
          <Button v-else full disabled size="lg"> Inscriptions fermées</Button>
        </div>
      </div>
    </div>
    <div class="block lg:hidden relative z-10">
      <div class="p-4 bg-white fixed bottom-0 left-0 right-0 border-t">
        <Link v-if="fresque.can_candidate" :href="route('fresques.candidate', { fresque })">
          <Button full size="lg"> Je m'inscris</Button>
        </Link>
        <Button v-else full disabled size="lg"> Inscriptions fermées</Button>
      </div>
    </div>
  </div>
</template>
