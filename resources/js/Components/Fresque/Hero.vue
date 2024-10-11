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
    <div class="">
      <div class="">
        <Link
          :href="route('fresques.index')"
          class="uppercase text-sm font-bold inline-flex items-center space-x-2 hover:text-[#444444]"
        >
          <RiArrowLeftLine size="24" class="fill-current" />
          <span>Retour aux fresques</span>
        </Link>
        <div class="flex justify-between items-center mt-2 mb-8">
          <h1 class="text-4xl lg:text-5xl font-bold">
            {{ fresque.place.city }} - {{ fresque.place.name }}
          </h1>
          <Share
            :url="route('fresques.show', fresque)"
            :title="fresque.place.city"
            description="Ma description"
            quote="My quote"
            hashtags="fresquebenevolat,jeveuxaider"
            class="hidden lg:block"
          />
        </div>

        <div
          v-if="fresque.default_picture"
          class="border rounded-xl overflow-hidden bg-white shadow-lg"
        >
          <div class="border-8 border-white rounded-lg overflow-hidden">
            <img
              :src="
                fresque.default_picture
                  ? fresque.default_picture
                  : '/images/default-placeholder.png'
              "
              alt="fresque"
              class="w-full h-auto lg:h-[430px] object-cover rounded-lg overflow-hidden"
            />
          </div>
        </div>

        <div class="mt-8" v-if="fresque.animators.length">
          Animée par {{ fresque.animators.map((item) => item.public_name).join(', ') }}
        </div>
      </div>
    </div>
  </div>
</template>
