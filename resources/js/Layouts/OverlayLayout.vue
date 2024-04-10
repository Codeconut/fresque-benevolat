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
  <div class="flex flex-col lg:justify-center lg:items-center relative lg:h-screen w-full">
    <Head :title="title" />
    <div class="lg:absolute lg:top-4 lg:right-8 flex justify-end">
      <div class="flex items-center hover:bg-white cursor-pointer py-1 px-2" @click="handleClose">
        <RiCloseLine class="h-4 top-[1px] relative" /> Fermer
      </div>
    </div>
    <main class="mt-8 lg:mt-0">
      <slot />
    </main>
  </div>
</template>
