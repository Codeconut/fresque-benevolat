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
  <div v-if="fresque.summary" class="bg-white shadow-lg p-12">
    <div class="flex items-center space-x-4 mb-6">
      <img v-svg-inline src="/images/icons/boussole.svg" alt="" class="text-red-100 w-[40px]" />
      <h2 class="text-2xl font-bold">Infos pratiques</h2>
    </div>

    <div v-if="fresque.summary" class="">
      <div class="markdown" v-html="markdown.render(fresque.summary)" />
    </div>
  </div>
</template>
