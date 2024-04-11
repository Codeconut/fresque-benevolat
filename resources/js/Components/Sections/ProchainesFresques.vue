<script setup>
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  fresques: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <div class="py-20">
    <div class="container">
      <div class="mb-16">
        <div class="flex space-x-3">
          <img src="/images/icons/megaphone.svg" alt="megaphone" class="" />
          <div>
            <h2 class="relative text-4xl lg:text-5xl leading-[56px] font-bold mb-4">
              Les prochaines fresques
            </h2>
            <div class="text-2xl text-[#666666]">
              Trouvez la prochaine fresque du bénévolat près de chez vous
            </div>
          </div>
        </div>
      </div>
      <div class="flex gap-8">
        <Link
          :href="route('fresques.show', { fresque: fresque.slug })"
          v-for="fresque in fresques"
          :key="fresque.id"
        >
          <FresqueCard class="" :fresque="fresque" orientation="vertical" />
        </Link>
      </div>
    </div>
  </div>
</template>
