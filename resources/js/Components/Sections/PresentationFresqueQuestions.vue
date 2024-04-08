<script setup>
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
</script>

<template>
  <div class="relative">
    <div class="container relative">
      <div class="p-16 bg-yellow-moutarde-main-679-active mt-12">
        <div class="">
          <div>Un atelier ludique et participatif</div>
          <div>(Presque) partout autour de chez vous</div>
          <div>Comprendre le bénévolat et passer à l’action</div>
          <Link :href="route('fresques.index')">
            <Button variant="custom" custom-class="border-[#161616] hover:bg-white"
              >Vous avez des questions</Button
            >
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
