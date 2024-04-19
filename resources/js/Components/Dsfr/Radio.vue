<script setup>
const props = defineProps({
  // modelValue: {
  //   type: Boolean,
  //   default: false,
  // },
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
  // customClass: {
  //   type: String,
  //   default: '',
  // },
  // required: {
  //   type: Boolean,
  //   default: false,
  // },
  // error: {
  //   type: Boolean,
  //   default: false,
  // },
})

// const emit = defineEmits(['update:modelValue'])

// const handleCheckboxChange = ($event) => {
//   emit('update:modelValue', $event.target.checked)
// }
</script>

<template>
  <div class="w-full relative">
    <input
      :name="name"
      :id="id"
      type="radio"
      class="cursor-pointer border-[#000091] h-6 w-6 rounded-full text-[#000091]"
      :value="value"
      :ckecked="checked"
    />
    <label class="ml-2 cursor-pointer" :for="id"> <slot /> {{ checked }} </label>
  </div>
</template>

<style lang="postcss" scoped></style>
