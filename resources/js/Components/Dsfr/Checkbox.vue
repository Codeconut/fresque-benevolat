<script setup>
const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: null,
  },
  id: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  customClass: {
    type: String,
    default: '',
  },
  required: {
    type: Boolean,
    default: false,
  },
})

const ariaDescribedby = `${props.name}-description`
</script>

<template>
  <div class="w-full relative">
    <input
      :name="name"
      :id="id"
      type="checkbox"
      :aria-describedby="ariaDescribedby"
      class="cursor-pointer h-6 w-6 rounded-md text-[#000091]"
    />
    <label class="ml-2 cursor-pointer" :for="name">
      <slot />
      <span v-if="required" class="text-[#E2011C]"> * </span>
    </label>
  </div>
</template>

<style lang="postcss" scoped></style>
