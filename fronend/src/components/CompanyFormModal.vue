<script setup>
import { ref } from 'vue'
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  DialogDescription,
} from '@headlessui/vue'

const props = defineProps({
  isOpen: {
    required: true
  },
  isEdit: {
    required: false,
    default: false
  }
})

const emits = defineEmits([
    'close'
])

function close() {
  emits('close')
}

</script>

<template>
  <Dialog :open="isOpen" @close="close">
    <div class="tw-fixed tw-inset-0 tw-bg-black/30" aria-hidden="true" />
    <DialogPanel>
      <DialogTitle>{{ `${isEdit ? "Edit" : "Create"} Company` }}</DialogTitle>

      <button @click="close">Cancel</button>
    </DialogPanel>
  </Dialog>
</template>

<style scoped>

</style>