<script setup>
defineProps({
  variant: {
    type: String,
    default: 'primary',
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
  disabled: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <button
    :type="type"
    :class="[
      {
        'text-white bg-jva-blue-500 hover:bg-jva-blue-800 active:bg-jva-blue-900 border-transparent':
          variant === 'primary',
      },
      { 'px-2 py-1 text-xs min-h-[32px]': size === 'xs' },
      { 'px-3 py-1 text-sm min-h-[34px]': size === 'sm' },
      { 'px-4 py-2 text-base min-h-[42px]': size === 'md' },
      { 'px-6 py-2 text-lg min-h-[3rem]': size === 'lg' },
      { 'px-8 py-3 text-xl min-h-[3.5rem]': size === 'xl' },

      disabled ? 'cursor-not-allowed' : 'cursor-pointer',
    ]"
    class="font-medium inline-flex items-center justify-center whitespace-pre-wrap flex-none border border-transparent transition ease-in-out duration-150"
  >
    <slot />
  </button>
</template>
