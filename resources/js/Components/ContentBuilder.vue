<script setup>
import MarkdownIt from 'markdown-it'

defineProps({
  content: {
    type: Array,
    default: () => [],
  },
})

const markdown = new MarkdownIt()
</script>

<template>
  <div class="flex flex-col gap-8">
    <div v-for="(bloc, i) in content" :key="i" class="">
      <template v-if="bloc.type === 'heading'">
        <h1 v-if="bloc.data.level === 'h1'" class="text-5xl font-bold">{{ bloc.data.content }}</h1>
        <h2 v-if="bloc.data.level === 'h2'" class="text-3xl font-bold">{{ bloc.data.content }}</h2>
        <h3 v-if="bloc.data.level === 'h3'" class="text-2xl font-bold">{{ bloc.data.content }}</h3>
      </template>
      <template v-if="bloc.type === 'paragraph'">
        <div class="markdown" v-html="markdown.render(bloc.data.content)" />
      </template>
      <template v-if="bloc.type === 'image'">
        <img :src="`/storage/${bloc.data.url}`" :alt="bloc.data.alt" />
      </template>
    </div>
  </div>
</template>
