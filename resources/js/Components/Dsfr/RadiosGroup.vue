<script setup>
import { Radio } from '@/Components/Dsfr'

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: null,
  },
  name: {
    type: String,
    required: true,
  },
  options: {
    type: Array,
    required: true,
  },
  size: {
    type: String,
    default: 'md',
    validator: (s) => ['md', 'lg'].includes(s),
  },
  error: {
    type: Boolean,
    default: null,
  },
  success: {
    type: Boolean,
    default: null,
  },
  customClass: {
    type: String,
    default: '',
  },
})

const emit = defineEmits(['update:modelValue'])

const handleRadioClick = ($event) => {
  emit('update:modelValue', $event.target.value)
}
</script>

<template>
  <div class="w-full relative" :id="name">
    <Radio
      v-for="(option, i) in options"
      :key="i"
      :name="name"
      :id="`${name}-${i}`"
      :value="option.value"
      :checked="modelValue === option.value"
      @click="handleRadioClick"
    >
      {{ option.label }} {{ modelValue === option.value }}
    </Radio>
  </div>
</template>

<style lang="postcss" scoped>
/* select {
  --tw-ring-shadow: 0 0 #000 !important;
} */
</style>
