<script setup>
const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  value: {
    type: String,
    default: null,
  },
  checked: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <div class="w-full relative">
    <input
      :name="name"
      :id="id"
      type="radio"
      class="cursor-pointer border-[#000091] h-6 w-6 rounded-full text-[#000091]"
      :value="value"
      :checked="checked"
    />
    <label class="ml-2 cursor-pointer" :for="id"> <slot /> </label>
  </div>
</template>

<style lang="postcss" scoped></style>
