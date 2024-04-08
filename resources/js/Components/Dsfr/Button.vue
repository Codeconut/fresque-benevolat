<script setup>
defineProps({
  variant: {
    type: String,
    default: 'primary',
    validator: (s) => ['primary', 'secondary', 'tertiary', 'tertiary-no-outline'].includes(s),
  },
  type: {
    type: String,
    default: 'button',
  },
  size: {
    type: String,
    default: 'md',
    validator: (s) => ['xs', 'sm', 'md', 'lg'].includes(s),
  },
  full: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <button
    :type="type"
    class="font-medium inline-flex items-center justify-center whitespace-pre-wrap flex-none border transition ease-in-out duration-150"
    :class="[
      {
        'text-white bg-blue-france-sun-113 hover:bg-blue-france-sun-113-hover active:bg-blue-france-sun-113-active border-transparent':
          variant === 'primary',
      },
      {
        'text-blue-france-sun-113 border-blue-france-sun-113 bg-white hover:bg-[#F6F6F6] active:bg-[#EDEDED]':
          variant === 'secondary',
      },
      { 'px-2 py-1 text-xs min-h-[32px]': size === 'xs' },
      { 'px-3 py-1 text-sm min-h-[34px]': size === 'sm' },
      { 'px-4 py-2 text-base min-h-[42px]': size === 'md' },
      { 'px-6 py-2 text-lg min-h-[3rem]': size === 'lg' },
      { 'px-8 py-3 text-xl min-h-[3.5rem]': size === 'xl' },
      { 'w-full': full },

      disabled ? 'cursor-not-allowed' : 'cursor-pointer',
    ]"
  >
    <slot />
  </button>
</template>
