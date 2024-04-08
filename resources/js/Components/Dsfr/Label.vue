<script setup>
defineProps({
  htmlFor: {
    type: String,
    default: null,
  },
  suffix: {
    type: String,
    default: null,
  },
  required: {
    type: Boolean,
    default: false,
  },
  size: {
    type: String,
    default: 'md',
  },
})
</script>

<template>
  <label
    :for="htmlFor"
    class="block mb-2 relative text-[#161616]"
    :class="[
      { 'text-xs normal-case': size === 'xs' },
      { 'text-md normal-case': size === 'md' },
      { 'text-xl normal-case': size === 'xl' },
    ]"
  >
    <slot />
    <span v-if="required" class="text-[#E2011C]"> * </span>
    <span v-if="suffix" class="ml-2">{{ suffix }}</span>
  </label>
</template>
