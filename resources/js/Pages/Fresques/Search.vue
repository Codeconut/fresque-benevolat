<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import queryString from 'query-string'
import { Select, Label, Pagination } from '@/Components/Dsfr'
import Faq from '@/Components/Sections/Faq.vue'
import JVAPretAPasserAction from '@/Components/Sections/JVAPretAPasserAction.vue'
import BlocJVAPretAPasserAction from '@/Components/Blocs/JVAPretAPasserAction.vue'
import EstCeQueCestFaitPourMoi from '@/Components/Blocs/EstCeQueCestFaitPourMoi.vue'

const props = defineProps({
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

const citiesOptions = props.cities.map((option) => {
  return { value: option.city, label: `${option.city} (${option.count})` }
})
citiesOptions.unshift({ value: '', label: 'Toutes les villes' })

const onCitiesChange = (event) => {
  router.visit(route('fresques.index'), {
    data: { 'filter[place.city]': event },
    only: ['fresques'],
  })
}

const changePage = (page) => {
  router.visit(route('fresques.index', { page }), {
    only: ['fresques'],
  })
}
</script>

<template>
  <AppLayout title="Fresques Benevolat">
    <div class="relative">
      <img
        class="absolute top-[-100px] right-0"
        :src="`${$page.props.assetUrl}/images//illustrations/dashed-line-1.svg`"
        alt=""
      />
      <img
        class="absolute top-[530px] left-0"
        :src="`${$page.props.assetUrl}/images//illustrations/dashed-line-4.svg`"
        alt=""
      />
    </div>
    <div class="container">
      <div class="relative py-[48px] lg:py-[64px]">
        <div class="relative">
          <div class="max-w-3xl pb-6">
            <h1 class="font-bold text-[40px] leading-[48px] lg:text-[56px] lg:leading-[64px]">
              (re)Découvre le bénévolat en participant à la Fresque
            </h1>
            <p class="text-[22px] lg:text-2xl my-8">
              Trouve la prochaine fresque du bénévolat près de chez toi
            </p>
            <img
              class="hidden xl:block xl:absolute xl:bottom-0 xl:right-0"
              :src="`${$page.props.assetUrl}/images//illustrations/playcards-2.svg`"
              alt=""
            />
          </div>
        </div>

        <div class="border-t py-14">
          <div v-if="cities.length" class="mb-12">
            <div class="w-full max-w-[400px]">
              <Label for="city" class="font-bold uppercase" size="sm">Recherche par lieu</Label>
              <Select
                id="city"
                name="city"
                v-model="selectedCity"
                placeholder="Sélectionne une ville"
                :options="citiesOptions"
                @update:modelValue="onCitiesChange"
              />
            </div>
          </div>
          <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">
            <div class="col-span-2">
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
                <Pagination
                  v-if="fresques.last_page > 1"
                  class="mt-8"
                  :current-page="fresques.current_page"
                  :total-rows="fresques.total"
                  :per-page="fresques.per_page"
                  @page-change="changePage"
                />
              </div>
            </div>
            <div class="space-y-8 mt-24 lg:mt-0">
              <EstCeQueCestFaitPourMoi />
              <BlocJVAPretAPasserAction class="hidden lg:block" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="lg:border-t lg:py-14">
        <Faq />
      </div>
    </div>
    <div class="lg:container pt-6 lg:py-14">
      <JVAPretAPasserAction />
    </div>
  </AppLayout>
</template>
