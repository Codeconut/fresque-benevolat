<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PassezActionAvecFresquesBenevolat from '@/Components/Sections/PassezActionAvecFresquesBenevolat.vue'
import PresentationFresqueQuestions from '@/Components/Sections/PresentationFresqueQuestions.vue'
import ProfessionnelsAideOrganiserFresque from '@/Components/Sections/ProfessionnelsAideOrganiserFresque.vue'
import Faq from '@/Components/Sections/Faq.vue'
import Chiffres from '@/Components/Sections/Chiffres.vue'
import DevenezAnimateur from '@/Components/Sections/DevenezAnimateur.vue'
import JVAPretAPasserAction from '@/Components/Sections/JVAPretAPasserAction.vue'
import Testimonials from '@/Components/Sections/Testimonials.vue'
import SwiperProchainesFresques from '@/Components/Sections/SwiperProchainesFresques.vue'

const props = defineProps({
  fresques: {
    type: Object,
    default: () => null,
  },
})
</script>

<template>
  <AppLayout>
    <div class="relative">
      <img
        class="absolute top-[530px] left-0"
        :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-2.svg`"
        alt=""
      />
      <div class="relative noise bg-dsfr-beige">
        <PassezActionAvecFresquesBenevolat class="relative z-10" />
      </div>
      <div class="relative noise bg-[#FDE2B5]">
        <PresentationFresqueQuestions class="relative z-10" />
      </div>
    </div>

    <div class="relative noise bg-dsfr-beige">
      <SwiperProchainesFresques :fresques="fresques?.data" />
    </div>

    <div class="relative noise bg-dsfr-beige">
      <Testimonials class="relative z-10" />
    </div>
    <div class="relative noise bg-[#9EF9BE]">
      <Chiffres class="relative z-10" />
    </div>
    <div class="relative noise bg-dsfr-beige">
      <DevenezAnimateur class="relative z-10" />
    </div>

    <div class="relative noise bg-dsfr-beige">
      <img
        class="absolute top-[530px] left-0"
        :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-7.svg`"
        alt=""
      />
      <div class="container">
        <Faq class="relative z-10" />
        <ProfessionnelsAideOrganiserFresque class="relative z-10" />
      </div>
    </div>
    <div class="relative noise bg-[#F5F5FE]">
      <JVAPretAPasserAction />
    </div>
  </AppLayout>
</template>
