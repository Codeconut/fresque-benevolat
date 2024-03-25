<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import ApplicationMark from '@/Components/ApplicationMark.vue'
import Banner from '@/Components/Banner.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import Header from '@/Components/Header.vue'

defineProps({
  title: String,
})
</script>

<template>
  <div>
    <Head :title="title" />

    <Banner />

    <Header />

    <div class="min-h-screen bg-[#F9F6F2]">
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
