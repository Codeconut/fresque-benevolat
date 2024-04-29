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
    <div class="relative overflow-hidden">
      <div
        :class="[
          'top-0 left-0 py-6 lg:py-24 bg-dsfr-beige z-[100] min-h-screen',
          {
            'fixed inset-0': fixed,
            'relative  ': !fixed,
          },
        ]"
      >
        <img
          class="hidden lg:block lg:absolute top-[-100px] right-0 z-1"
          src="/images/illustrations/dashed-line-1.svg"
          alt=""
        />
        <img
          class="absolute top-[600px] left-0 z-1"
          src="/images/illustrations/dashed-line-6.svg"
          alt=""
        />
        <div
          :class="[
            'flex flex-col',
            {
              'justify-center items-center h-full': fixed,
              ' ': !fixed,
            },
          ]"
          v-scroll-lock="fixed"
        >
          <Head v-if="headTitle" :title="headTitle" />
          <div class="lg:absolute lg:top-4 lg:right-8 flex justify-end z-10">
            <div
              class="flex items-center hover:bg-white cursor-pointer py-1 px-2"
              @click="handleClose"
            >
              <RiCloseLine class="h-4 top-[1px] relative" /> Fermer
            </div>
          </div>
          <div :class="[{ 'mt-8 pb-8 lg:mt-0  z-10': !fixed }]">
            <slot />
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>
