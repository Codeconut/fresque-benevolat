<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import queryString from 'query-string'
import { Select, Label } from '@/Components/Dsfr'

defineProps({
  fresques: {
    type: Object,
    required: true,
  },
  cities: {
    type: Array,
    default: () => [],
  },
})

const selectedCity = ref(queryString.parse(location.search)?.['filter[place.city]'] || null)

const onCitiesChange = (event) => {
  router.visit(route('fresques.index'), {
    data: { 'filter[place.city]': event },
    only: ['fresques'],
  })
}
</script>

<template>
  <AppLayout title="Fresques Benevolat">
    <div class="container py-24">
      <div v-if="cities.length" class="mb-12">
        <div class="w-full max-w-[400px]">
          <Label for="city" class="font-bold uppercase" size="sm">Recherche par lieu</Label>
          <Select
            id="city"
            name="city"
            v-model="selectedCity"
            placeholder="Sélectionner une ville"
            :options="
              cities.map((option) => {
                return { value: option.city, label: `${option.city} (${option.count})` }
              })
            "
            @update:modelValue="onCitiesChange"
          />
        </div>
      </div>
      <div v-if="fresques">
        <div class="grid grid-cols-1 gap-8">
          <Link
            :href="route('fresques.show', { fresque: fresque.slug })"
            v-for="fresque in fresques.data"
            :key="fresque.id"
          >
            <FresqueCard class="" :fresque="fresque" />
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
