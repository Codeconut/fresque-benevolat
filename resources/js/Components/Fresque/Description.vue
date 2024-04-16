<script setup>
import ContentBuilder from '@/Components/ContentBuilder.vue'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div v-if="fresque.content" class="bg-white shadow-lg p-12">
    <ContentBuilder :content="fresque.content" />
  </div>
</template>
