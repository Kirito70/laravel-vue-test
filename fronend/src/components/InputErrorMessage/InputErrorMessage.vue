<script setup>
const props = defineProps({
  errors: {
    required: true,
  }
})
</script>

<template>
    <p v-if="errors && errors.length" class="tw-text-red-800">
       {{ errors[0] }}
    </p>
</template>
