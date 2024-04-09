<script setup>
const props = defineProps({
  modelValue: {
    type: Boolean,
    default: false,
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
  error: {
    type: Boolean,
    default: false,
  },
})

const emit = defineEmits(['update:modelValue'])

const ariaDescribedby = `${props.name}-description`

const handleCheckboxChange = ($event) => {
  emit('update:modelValue', $event.target.checked)
}
</script>

<template>
  <div class="w-full relative">
    <input
      :name="name"
      :id="name"
      type="checkbox"
      :aria-describedby="ariaDescribedby"
      class="cursor-pointer border-[#000091] h-6 w-6 rounded-md text-[#000091]"
      :class="[{ '!border-[#ce0500]': error }]"
      :checked="modelValue"
      @input="handleCheckboxChange"
    />
    <label class="ml-2 cursor-pointer" :class="[{ 'text-[#ce0500]': error }]" :for="name">
      <slot />
      <span v-if="required" class="text-[#E2011C]"> * </span>
    </label>
  </div>
</template>

<style lang="postcss" scoped></style>
