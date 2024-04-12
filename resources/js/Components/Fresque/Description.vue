<script setup>
defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div v-if="fresque.content" class="bg-white p-12">
    {{ fresque.content }}
  </div>
</template>
