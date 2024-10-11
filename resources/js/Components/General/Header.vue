<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import ApplicationMark from '@/Components/Jetstream/ApplicationMark.vue'
import { Button, IconButton } from '@/Components/Dsfr'
import { RiSearchLine } from '@remixicon/vue'

const logout = () => {
  router.post(route('logout'))
}
</script>

<template>
  <div class="relative bg-white shadow-md z-50 overflow-hidden">
    <div class="relative z-20 container">
      <div class="flex justify-between items-center h-[122px]">
        <div class="shrink-0 flex items-center">
          <Link :href="route('home')" class="flex items-center px-2 relative -left-4">
            <img :src="`${$page.props.assetUrl}/images/logos/logo-marianne.svg`" class="" />
            <ApplicationMark class="block w-auto" />
          </Link>
        </div>
        <div>
          <div class="flex items-center space-x-8">
            <!-- <div class="flex space-x-8">
              <template v-if="!$page.props.isLogged">
              <Link :href="route('login')" class="text-sm text-gray-700 underline">Connexion</Link>
              <Link :href="route('register')" class="text-sm text-gray-700 underline"
                >Inscription</Link
              >
            </template>
            <template v-if="$page.props.isLogged">
              <Link :href="route('dashboard')" class="text-sm text-gray-700 underline"
                >Dashboard</Link
              >
              <Link :href="route('profile.show')" class="text-sm text-gray-700 underline"
                >Profile</Link
              >
              <Link href="#" @click="logout" class="text-sm text-gray-700 underline">Logout</Link>
            </template>
            </div> -->

            <Link :href="route('fresques.index')">
              <Button class="hidden sm:block">Trouver une fresque</Button>
              <IconButton variant="secondary" class="sm:hidden" :icon="RiSearchLine" />
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
