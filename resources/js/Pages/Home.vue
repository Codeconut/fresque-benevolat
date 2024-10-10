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
import Partenaires from '@/Components/Sections/Partenaires.vue'

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
        class="hidden lg:inline lg:absolute lg:top-[530px] lg:left-0 z-10"
        :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-2.svg`"
        alt=""
      />
      <PassezActionAvecFresquesBenevolat class="" />
      <PresentationFresqueQuestions class="noise bg-[#FDE2B5]" />
    </div>

    <SwiperProchainesFresques :fresques="fresques?.data" class="" />

    <Testimonials class="" />
    <Chiffres class="noise bg-[#C3FAD5]" />

    <DevenezAnimateur class="" />

    <div class="relative">
      <img
        class="absolute top-[490px] left-0"
        :src="`${$page.props.assetUrl}/images/illustrations/dashed-line-7.svg`"
        alt=""
      />
      <div class="container relative z-10">
        <Faq />
        <ProfessionnelsAideOrganiserFresque />
        <Partenaires />
      </div>
    </div>
    <JVAPretAPasserAction class="noise bg-[#F2F2FD]" />
  </AppLayout>
</template>
