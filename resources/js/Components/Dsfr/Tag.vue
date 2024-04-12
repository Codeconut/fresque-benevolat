<script setup>
defineProps({
  variant: {
    type: String,
    default: 'default',
    validator: (s) =>
      ['default', 'clickable', 'selectable', 'deletable', 'unclickable'].includes(s),
  },
  size: {
    type: String,
    default: 'md',
    validator: (s) => ['xs', 'sm', 'md', 'lg'].includes(s),
  },
  icon: {
    type: Object,
    default: null,
  },
})
</script>

<template>
  <p
    class="inline-flex items-center justify-center rounded-full max-w-full relative transition"
    :class="[
      {
        'text-[#161616] bg-[#EEEEEE]': variant === 'default',
      },
      {
        'text-dsfr-blue bg-[#E3E3FD] hover:bg-[#C1C1FB] active:bg-[#ADADF9] cursor-pointer':
          variant === 'clickable',
      },
      {
        'text-dsfr-blue bg-[#E3E3FD]': variant === 'unclickable',
      },
      { 'px-2 py-0.5 text-xs h-6': size == 'sm' },
      { 'px-3 py-1 text-sm h-8': size == 'md' },
    ]"
  >
    <component
      v-if="icon"
      :is="icon"
      :class="[
        'relative flex-none fill-current top-[1px]',
        { 'w-3 h-3 mr-0.5': size === 'sm' },
        { 'w-4 h-4 mr-1': size === 'md' },
      ]"
    />
    <span class="truncate"><slot /></span>
  </p>
</template>
