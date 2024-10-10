<script setup>
import { defineComponent, ref, onMounted } from 'vue'
import { RiLoader4Line } from '@remixicon/vue'

const kpis = ref([])
const loading = ref(false)

onMounted(() => {
  fetchGlobalKpis()
})

const fetchGlobalKpis = () => {
  loading.value = true
  axios
    .get(route('global.kpis'))
    .then((response) => {
      kpis.value = response.data
    })
    .finally(() => {
      loading.value = false
    })
}
</script>

<template>
  <div class="">
    <div class="lg:container">
      <div class="overflow-hidden">
        <div class="text-[#142018]">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-8 py-12 lg:p-24">
            <div class="flex flex-col text-center items-center gap-4 lg:gap-8">
              <div>
                <img :src="`${$page.props.assetUrl}/images/icons/icon-star.svg`" alt="" />
              </div>
              <div>
                <div class="flex justify-center text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">
                  <template v-if="loading">
                    <RiLoader4Line size="64" class="animate-spin" />
                  </template>
                  <template v-else>{{ kpis?.applications_validated_count }}</template>
                </div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2">participant(e)s</div>
                <div class="text-lg lg:text-xl">depuis le lancement</div>
              </div>
            </div>
            <div class="flex flex-col text-center items-center gap-4 lg:gap-8">
              <div>
                <img :src="`${$page.props.assetUrl}/images/icons/icon-heart.svg`" alt="" />
              </div>
              <div>
                <div class="flex justify-center text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">
                  <template v-if="loading">
                    <RiLoader4Line size="64" class="animate-spin" />
                  </template>
                  <template v-else>{{ kpis?.fresques_passed_count }}</template>
                </div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2">fresques animées</div>
                <div class="text-lg lg:text-xl">dans plusieurs villes</div>
              </div>
            </div>
            <div class="flex flex-col text-center items-center gap-4 lg:gap-8">
              <div>
                <img :src="`${$page.props.assetUrl}/images/icons/icon-boussole-2.svg`" alt="" />
              </div>
              <div>
                <div class="flex justify-center text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">
                  <template v-if="loading">
                    <RiLoader4Line size="64" class="animate-spin" />
                  </template>
                  <template v-else>{{ kpis?.animators_count }}</template>
                </div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2">animateur(ice)s</div>
                <div class="text-lg lg:text-xl">formés à la fresque</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
