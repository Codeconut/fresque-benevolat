<script setup>
defineProps({
  href: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <a
    :href="href"
    class="text-dsfr-blue border-b border-dsfr-blue hover:border-b-2 cursor-pointer inline pb-1"
  >
    <slot />
  </a>
</template>
