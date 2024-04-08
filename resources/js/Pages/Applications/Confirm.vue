<script setup>
defineProps({
  application: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <div>
    <h1>Confirm {{ application }}</h1>
  </div>
</template>
