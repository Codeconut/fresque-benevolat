<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { RiArrowLeftLine, RiShareFill } from '@remixicon/vue'
import Share from '@/Components/Share.vue'

defineProps({
  fresque: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div class="overflow-hidden">
    <div class="p-8 lg:p-12 lg:pt-24 bg-dsfr-yellow-active fresque-show-clip-path">
      <div class="">
        <Link
          :href="route('fresques.index')"
          class="uppercase text-sm font-bold flex items-center space-x-2 hover:text-[#444444]"
        >
          <RiArrowLeftLine size="24" class="fill-current" />
          <span>Retour aux fresques</span>
        </Link>
        <div class="flex justify-between items-center mt-2 mb-8">
          <h1 class="text-5xl font-bold">{{ fresque.place.city }} - {{ fresque.place.name }}</h1>
          <Share
            :url="route('fresques.show', fresque)"
            :title="fresque.place.city"
            description="Ma description"
            quote="My quote"
            hashtags="fresquebenevolat,jeveuxaider"
          />
        </div>

        <img
          v-if="fresque.default_picture"
          :src="
            fresque.default_picture ? fresque.default_picture : '/images/default-placeholder.png'
          "
          alt="fresque"
          class="w-full h-[430px] object-cover rounded-lg"
        />

        <div class="mt-8" v-if="fresque.animators.length">
          Animé par {{ fresque.animators.map((item) => item.public_name).join(', ') }}
        </div>
      </div>
    </div>
  </div>
</template>
