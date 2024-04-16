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
  <AppLayout title="Accueil">
    <div class="relative">
      <img
        class="absolute top-[530px] left-0"
        src="/images/illustrations/dashed-line-2.svg"
        alt=""
      />
      <PassezActionAvecFresquesBenevolat class="relative z-10" />
      <PresentationFresqueQuestions class="relative z-10" />
    </div>

    <SwiperProchainesFresques :fresques="fresques?.data" />

    <Testimonials />
    <Chiffres />
    <DevenezAnimateur />
    <Faq />
    <ProfessionnelsAideOrganiserFresque />
    <JVAPretAPasserAction />
  </AppLayout>
</template>
