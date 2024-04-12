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

const props = defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const markdown = new MarkdownIt()
</script>

<template>
  <AppLayout :title="fresque.date">
    <div class="container">
      <div class="py-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
          <div class="col-span-2 space-y-12">
            <FresqueHero :fresque="fresque" />
            <FresqueDescription :fresque="fresque" />
            <FresqueInfosPratiques :fresque="fresque" />
            <Place :place="fresque.place" />
          </div>
          <div>
            <FresqueInscription :fresque="fresque" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
