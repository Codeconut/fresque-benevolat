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
  <div>HELLO WORLD</div>
</template>
