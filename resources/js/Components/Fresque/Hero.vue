<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { RiArrowLeftLine } from '@remixicon/vue'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="overflow-hidden">
    <div
      class="w-0 h-0 border-t-[60px] border-t-transparent border-l-[1284px] border-l-dsfr-yellow-active border-b-[0px] border-b-transparent"
    ></div>
    <div class="p-8 lg:p-12 lg:pt-6 bg-dsfr-yellow-active">
      <div class="">
        <Link
          :href="route('fresques.index')"
          class="uppercase text-sm font-bold flex items-center space-x-2 hover:text-[#444444]"
        >
          <RiArrowLeftLine size="24" class="fill-current" />
          <span>Retour aux fresques</span>
        </Link>
        <div class="mt-2 mb-8">
          <h1 class="text-5xl font-bold">{{ fresque.place.city }}</h1>
        </div>

        <img
          v-if="fresque.cover"
          :src="fresque.cover ? `/storage/${fresque.cover}` : '/images/default-placeholder.png'"
          alt="fresque"
          class="w-full h-[430px] object-cover"
        />

        <div class="mt-8" v-if="fresque.animators.length">
          Animé par {{ fresque.animators.map((item) => item.public_name).join(', ') }}
        </div>
      </div>
    </div>
  </div>
</template>
