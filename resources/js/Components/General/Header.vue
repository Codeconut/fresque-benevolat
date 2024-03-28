<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import ApplicationMark from '@/Components/Jetstream/ApplicationMark.vue'
import Button from '@/Components/Dsfr/Button.vue'

const logout = () => {
  router.post(route('logout'))
}
</script>

<template>
  <div class="container">
    <div class="flex justify-between items-center h-16">
      <div class="shrink-0 flex items-center">
        <Link :href="route('home')">
          <ApplicationMark class="block h-9 w-auto" />
        </Link>
      </div>
      <div>
        <div class="flex items-center space-x-8">
          <div class="flex space-x-8">
            <!-- <template v-if="!$page.props.isLogged">
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
            </template> -->
          </div>

          <Link :href="route('fresques.index')">
            <Button>Trouver une fresque</Button>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
