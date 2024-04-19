<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { RiCloseLine } from '@remixicon/vue'

const props = defineProps({
  headTitle: String,
  redirectUrl: String,
  fixed: Boolean,
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
    <div
      :class="[
        'top-0 left-0 py-12 lg:py-24 bg-dsfr-beige z-[100]',
        {
          'fixed inset-0': fixed,
          'realtive ': !fixed,
        },
      ]"
    >
      <div
        :class="[
          'flex flex-col',
          {
            'justify-center items-center h-screen': fixed,
            ' ': !fixed,
          },
        ]"
        v-scroll-lock="fixed"
      >
        <Head v-if="headTitle" :title="headTitle" />
        <div class="lg:absolute lg:top-4 lg:right-8 flex justify-end">
          <div
            class="flex items-center hover:bg-white cursor-pointer py-1 px-2"
            @click="handleClose"
          >
            <RiCloseLine class="h-4 top-[1px] relative" /> Fermer
          </div>
        </div>
        <div class="mt-8 pb-8 lg:mt-0">
          <slot />
        </div>
      </div>
    </div>
  </Teleport>
</template>
