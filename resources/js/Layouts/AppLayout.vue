<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import ApplicationMark from '@/Components/Jetstream/ApplicationMark.vue'
import Banner from '@/Components/Jetstream/Banner.vue'
import Dropdown from '@/Components/Jetstream/Dropdown.vue'
import DropdownLink from '@/Components/Jetstream/DropdownLink.vue'
import NavLink from '@/Components/Jetstream/NavLink.vue'
import ResponsiveNavLink from '@/Components/Jetstream/ResponsiveNavLink.vue'
import Header from '@/Components/General/Header.vue'
import Footer from '@/Components/General/Footer.vue'

defineProps({
  title: {
    type: String,
    default: 'LA fresque qui t’amène du point A au point Bénévolat !',
  },
  description: {
    type: String,
    default:
      'Participe à un atelier participatif de 2h30 top chrono et découvre le bénévolat sous toutes ses formes ! Créé et animé avec amour par JeVeuxAider.gouv.fr.',
  },
  imagePath: {
    type: String,
    default: '/images/illustrations/fresque-benevolat-image.jpg',
  },
})

const url = new URL(location.href)
const baseUrl = `${url.protocol}//${url.hostname}`
</script>

<template>
  <div class="min-h-screen">
    <Head :title="title">
      <meta property="type" content="website" />
      <meta property="title" :content="title" />
      <meta name="description" :content="description" />
      <meta property="image" :content="`${baseUrl}${imagePath}`" />
      <meta property="url" :content="url" />

      <meta property="og:type" content="website" />
      <meta property="og:title" :content="title" />
      <meta property="og:description" :content="description" />
      <meta property="og:url" :content="url" />
      <meta property="og:image" :content="`${baseUrl}${imagePath}`" />
    </Head>

    <Banner />

    <Header />

    <div class="">
      <main>
        <slot />
      </main>
    </div>
    <Footer />
  </div>
</template>
