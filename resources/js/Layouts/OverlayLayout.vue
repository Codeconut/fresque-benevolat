<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { RiCloseLine } from '@remixicon/vue'

const props = defineProps({
  title: String,
  redirectUrl: String,
})

const handleClose = () => {
  if (props.redirectUrl) {
    router.visit(props.redirectUrl)
  } else {
    router.back()
  }
}
</script>

<template>
  <div
    class="flex flex-col justify-center items-center relative h-screen bg-beige-gris-galet-975 w-full"
  >
    <Head :title="title" />
    <div
      class="absolute top-4 right-8 flex items-center hover:bg-white cursor-pointer py-1 px-2"
      @click="handleClose"
    >
      <RiCloseLine class="h-4 top-[1px] relative" /> Fermer
    </div>
    <main class="">
      <slot />
    </main>
  </div>
</template>
