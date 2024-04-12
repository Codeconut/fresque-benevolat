<script setup>
import MarkdownIt from 'markdown-it'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})

const markdown = new MarkdownIt()
</script>

<template>
  <div v-if="fresque.summary" class="bg-white p-10">
    <h2 class="text-2xl font-bold">Infos pratiques</h2>
    <div v-if="fresque.summary" class="">
      <div class="markdown" v-html="markdown.render(fresque.summary)" />
    </div>
  </div>
</template>
