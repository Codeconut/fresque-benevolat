<script setup>
import { Label } from '@/Components/Dsfr'
import { computed } from 'vue'
import { RiCloseCircleFill, RiInformationLine } from '@remixicon/vue'

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    default: null,
  },
  required: {
    type: Boolean,
    default: false,
  },
  error: {
    type: String,
    default: null,
  },
  info: {
    type: String,
    default: null,
  },
})

const hasError = computed(() => props.error)
const hasInfo = computed(() => props.info)
</script>

<template>
  <div class="relative">
    <Label :html-for="name" :required="required">
      {{ label }}
    </Label>
    <slot />
    <div class="mt-2">
      <div v-if="hasError" class="flex items-center text-[#ce0500] text-xs">
        <RiCloseCircleFill class="h-4" /> {{ error }}
      </div>
      <div v-else-if="hasInfo" class="flex items-center text-[#0063CB] text-xs">
        <RiInformationLine class="h-4" /> {{ info }}
      </div>
    </div>
  </div>
</template>
