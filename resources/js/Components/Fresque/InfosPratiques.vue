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
  <div v-if="fresque.summary" class="bg-white shadow-lg p-8 lg:p-12">
    <div class="flex items-center space-x-4 mb-6">
      <img
        v-svg-inline
        src="/images/icons/boussole.svg"
        alt=""
        class="text-[#6B93F6] w-[40px] focus:outline-none"
      />
      <h2 class="text-2xl lg:text-3xl font-bold">Infos pratiques</h2>
    </div>

    <div v-if="fresque.summary" class="">
      <div class="markdown" v-html="markdown.render(fresque.summary)" />
    </div>
  </div>
</template>
