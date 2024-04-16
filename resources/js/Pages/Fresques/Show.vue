<script setup>
import { defineComponent, ref, computed } from 'vue'

import AppLayout from '@/Layouts/AppLayout.vue'
import MarkdownIt from 'markdown-it'
import { Head, Link, router } from '@inertiajs/vue3'
import Place from '@/Components/Blocs/Place.vue'
import FresqueHero from '@/Components/Fresque/Hero.vue'
import FresqueDescription from '@/Components/Fresque/Description.vue'
import FresqueInfosPratiques from '@/Components/Fresque/InfosPratiques.vue'
import FresqueInscription from '@/Components/Fresque/Inscription.vue'
import Faq from '@/Components/Sections/Faq.vue'
import JVAPretAPasserAction from '@/Components/Sections/JVAPretAPasserAction.vue'
import ProchainesFresquesAlentours from '@/Components/Sections/ProchainesFresquesAlentours.vue'

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
  fresquesAlentours: {
    type: Array,
    required: true,
  },
})

const markdown = new MarkdownIt()
</script>

<template>
  <AppLayout
    :title="`À ${fresque.place.city}, le ${$dayjs(fresque.date).format('DD MMMM YYYY')} de
          ${fresque.schedules}`"
  >
    <div class="relative">
      <img
        class="absolute top-[-100px] right-0"
        src="/images/illustrations/dashed-line-1.svg"
        alt=""
      />
      <img
        class="absolute top-[530px] left-0"
        src="/images/illustrations/dashed-line-4.svg"
        alt=""
      />
    </div>
    <div class="container">
      <div class="relative py-12 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-12">
          <div class="col-span-2 space-y-12 order-2 lg:order-1">
            <FresqueHero :fresque="fresque" />
            <FresqueDescription :fresque="fresque" />
            <FresqueInfosPratiques :fresque="fresque" />
            <Place :place="fresque.place" />
          </div>
          <div class="col-span-1 order-1 lg:order-2 mb-12 lg:mb-0">
            <FresqueInscription :fresque="fresque" />
          </div>
        </div>
      </div>
    </div>
    <div class="py-14">
      <div class="container"><div class="border-t" /></div>
      <ProchainesFresquesAlentours :fresques="fresquesAlentours" />
      <Faq />
      <JVAPretAPasserAction />
    </div>
  </AppLayout>
</template>
