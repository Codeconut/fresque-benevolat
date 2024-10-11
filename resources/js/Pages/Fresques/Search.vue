<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import FresqueCard from '@/Components/FresqueCard.vue'
import { Link, router } from '@inertiajs/vue3'
import queryString from 'query-string'
import { Select, Label, Pagination } from '@/Components/Dsfr'
import Faq from '@/Components/Sections/Faq.vue'
import JVAPretAPasserAction from '@/Components/Sections/JVAPretAPasserAction.vue'
import BlocJVAPretAPasserAction from '@/Components/Blocs/JVAPretAPasserAction.vue'
import EstCeQueCestFaitPourMoi from '@/Components/Blocs/EstCeQueCestFaitPourMoi.vue'
import { usePage } from '@inertiajs/vue3'
import { useUrlQuery } from '@/Composables/useUrlQuery'
import { ref } from 'vue'
import NewsletterNeRatePasLesProchainesFresques from '@/Components/Sections/NewsletterNeRatePasLesProchainesFresques.vue'
import SwiperOverFresques from '@/Components/Sections/SwiperOverFresques.vue'

const props = defineProps({
  fresques: {
    type: Object,
    required: true,
  },
  oldFresques: {
    type: Array,
    default: () => [],
  },
  cities: {
    type: Array,
    default: () => [],
  },
})

const query = useUrlQuery()
const selectedCity = ref(query?.['filter[place.city]'] || null)

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
        :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-1.svg`"
        alt=""
      />
      <img
        class="absolute top-[530px] left-0"
        :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-4.svg`"
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
              :src="`${$page.props.assetUrl}/images/illustrations/playcards-2.svg`"
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

          <template v-if="fresques?.data.length > 0">
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">
              <div class="col-span-2">
                <div>
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
          </template>
          <template v-else>
            <div class="flex flex-col items-center space-y-8 lg:space-y-12">
              <div class="flex flex-col items-center justify-center gap-8 mt-8 lg:mt-12">
                <img
                  class="h-[82px] w-[70px] lg:h-[122px] lg:w-[105px]"
                  :src="`${$page.props.assetUrl}/images/no-result.png`"
                  alt=""
                />
                <div class="text-[#161616] text-xl lg:text-[28px] font-bold">
                  Il n’y a pas de fresque en ligne pour le moment 😥
                </div>
              </div>
              <NewsletterNeRatePasLesProchainesFresques class="max-w-[794px] w-full" />
            </div>
          </template>
        </div>
      </div>
    </div>
    <div v-if="fresques?.data.length > 0" class="container">
      <div class="lg:py-14">
        <NewsletterNeRatePasLesProchainesFresques class="max-w-[794px] w-full mx-auto" />
      </div>
    </div>
    <div class="container">
      <div class="lg:border-t lg:py-14">
        <SwiperOverFresques :fresques="oldFresques" />
        <Faq />
      </div>
    </div>
    <div class="section-divider-beige-bleu"></div>
    <JVAPretAPasserAction class="bg-[#F5F5FE] noise" />
  </AppLayout>
</template>
