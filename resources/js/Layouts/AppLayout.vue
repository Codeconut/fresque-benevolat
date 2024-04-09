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

defineProps({
  title: String,
})
</script>

<template>
  <div class="min-h-screen">
    <Head :title="title" />

    <Banner />

    <Header />

    <div class="">
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
