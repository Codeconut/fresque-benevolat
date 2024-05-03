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
</script>

<template>
  <div class="block lg:hidden relative z-10">
    <div class="p-4 bg-white fixed bottom-0 left-0 right-0 border-t">
      <Link v-if="fresque.can_candidate" :href="route('fresques.candidate', { fresque })">
        <Button full size="lg"> Je m'inscris</Button>
      </Link>
      <Button v-else full disabled size="lg"> Inscriptions fermées</Button>
    </div>
  </div>
</template>
