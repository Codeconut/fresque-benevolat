<script setup>
import { computed } from 'vue'
import { RiCloseCircleFill } from '@remixicon/vue'

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: null,
  },
  name: {
    type: String,
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
    default: false,
  },
  type: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: null,
  },
  customClass: {
    type: String,
    default: '',
  },
})

const onKeypressSpace = (event) => {
  if (props.type === 'email') {
    event.preventDefault()
  }
}
</script>

<template>
  <div class="w-full relative">
    <input
      :id="name"
      :name="name"
      :value="modelValue"
      :type="type"
      :placeholder="placeholder"
      :class="[
        ' border-t-0 border-l-0 border-r-0 rounded-t w-full h-full border-b-2 border-[#3A3A3A] focus-visible:border-[#3A3A3A]',
        'bg-[#EEEEEE] focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#0a76f6]',
        { '!border-[#ce0500]': error },
        { '!border-[#18753c]': success },
        { 'py-3': size === 'lg' },
        customClass,
      ]"
      @keypress.space="onKeypressSpace"
      @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
</template>

<style lang="postcss" scoped>
/* input {
  --tw-ring-shadow: 0 0 #000 !important;
} */
</style>
