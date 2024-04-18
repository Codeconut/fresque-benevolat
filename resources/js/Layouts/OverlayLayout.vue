<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { RiCloseLine } from '@remixicon/vue'

const props = defineProps({
  headTitle: String,
  redirectUrl: String,
})

const emit = defineEmits(['close'])

const handleClose = () => {
  if (props.redirectUrl) {
    router.visit(props.redirectUrl)
  }

  emit('close')
}
</script>

<template>
  <Teleport to="body">
    <div class="fixed top-0 left-0 h-screen w-screen bg-dsfr-beige z-[100]">
      <div class="flex flex-col lg:justify-center lg:items-center h-full overflow-y-auto">
        <Head v-if="headTitle" :title="headTitle" />
        <div class="lg:absolute lg:top-4 lg:right-8 flex justify-end">
          <div
            class="flex items-center hover:bg-white cursor-pointer py-1 px-2"
            @click="handleClose"
          >
            <RiCloseLine class="h-4 top-[1px] relative" /> Fermer
          </div>
        </div>
        <div class="mt-8 pb-8 lg:mt-0" v-scroll-lock="true">
          <slot />
        </div>
      </div>
    </div>
  </Teleport>
</template>
