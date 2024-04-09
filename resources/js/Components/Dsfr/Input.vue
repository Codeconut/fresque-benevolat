<script setup>
const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: null,
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
  type: {
    type: String,
    default: 'text',
  },
  id: {
    type: String,
    required: true,
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
      :id="id"
      :value="modelValue"
      :type="type"
      :placeholder="placeholder"
      :class="[
        'border-none rounded-t w-full h-full',
        'bg-[#EEEEEE] focus:ring-2 focus:ring-offset-2 ring-[#0a76f6] ',
        { '!ring-[#ce0500]': error },
        { '!ring-[#18753c]': success },
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
