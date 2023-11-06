<script setup>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot
} from "@headlessui/vue";
import {ref} from "vue";

const props = defineProps({
  url: {
    required: true
  },
  isOpen: {
    required: true
  }
})

const emits = defineEmits([
  'close'
])

const deleteItem = () => {
  loading.value = true

  axios.post(props.url, {
    _method: "DELETE"
  }).then((response) => {
    close()
  })
}


function close() {
  emits('close')
}

const loading = ref(false)
</script>

<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" :open="isOpen" @close="close" class="tw-relative tw-z-10">
      <TransitionChild
          as="template"
          enter="tw-duration-300 tw-ease-out"
          enter-from="tw-opacity-0"
          enter-to="tw-opacity-100"
          leave="tw-duration-200 tw-ease-in"
          leave-from="tw-opacity-100"
          leave-to="tw-opacity-0"
      >
        <div class="tw-fixed tw-inset-0 tw-bg-black/50"/>
      </TransitionChild>
      <div class="tw-fixed tw-inset-0 tw-overflow-y-auto">
        <div
            class="tw-flex tw-min-h-full tw-items-center tw-justify-center tw-p-4 tw-text-center"
        >
          <TransitionChild
              as="template"
              enter="tw-duration-300 tw-ease-out"
              enter-from="tw-opacity-0 tw-scale-95"
              enter-to="tw-opacity-100 tw-scale-100"
              leave="tw-duration-200 tw-ease-in"
              leave-from="tw-opacity-100 tw-scale-100"
              leave-to="tw-opacity-0 tw-scale-95"
          >
            <DialogPanel
                class="tw-w-full tw-max-w-md tw-transform tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-p-6 tw-text-left tw-align-middle tw-shadow-xl tw-transition-all"
            >
              <DialogTitle
                  as="h3"
                  class="tw-text-lg tw-font-medium tw-leading-6 tw-text-gray-900"
              >Are you sure?
              </DialogTitle>

              <div class="tew-mt-3">
                <p class="tw-text-sm tw-text-gray-500">
                  Do you really want delete this model?
                </p>
              </div>

              <div class="tw-mt-3 tw-flex tw-justify-between">
                <button
                    type="button"
                    class="tw-inline-flex tw-justify-center tw-rounded-md tw-border tw-border-transparent tw-bg-green-100 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-blue-900 hover:tw-bg-blue-200 focus:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-blue-500 focus-visible:tw-ring-offset-2"
                    @click="close">Cancel
                </button>
                <button
                    class="tw-inline-flex tw-justify-center tw-rounded-md tw-border tw-border-transparent tw-bg-red-100 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-blue-900 hover:tw-bg-blue-200 focus:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-blue-500 focus-visible:tw-ring-offset-2"
                    type="button"
                    @click="deleteItem"
                    :loading="loading"
                >
                  Delete
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<style scoped>

</style>