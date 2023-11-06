<script setup>
import {ref} from 'vue'
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  DialogDescription,
  TransitionRoot,
  TransitionChild
} from '@headlessui/vue'
import InputErrorMessage from "@/components/InputErrorMessage/InputErrorMessage.vue";

const props = defineProps({
  isOpen: {
    required: true
  },
  isEdit: {
    required: false,
    default: false
  }
})

const errors = ref({})
const loading = ref(false)
const data = ref({
  name: '',
  email: '',
  logo: '',
  website: ''
})

const emits = defineEmits([
  'close'
])

function close() {
  emits('close')
}

const createCompany = () => {

}

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
              >{{ `${isEdit ? "Edit" : "Create"} Company` }}</DialogTitle>

              <div class="tew-mt-2">
                <form @submit.prevent="createCompany">
                  <div class="tw-p-4">
                    <div class="tw-mb-4">
                      <label for="email" class="tw-mt-5">Company name</label>
                      <input required type="text" name="name"
                             class="tw-mt-1 tw-px-3 tw-py-2 tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             placeholder="Company Name" v-model="data.name"/>
                      <InputErrorMessage :errors="errors.name"/>
                    </div>
                    <div class="tw-mb-4">
                      <label for="email" class="tw-mt-5">Company Email</label>
                      <input required type="email" name="email"
                             class="tw-mt-1 tw-px-3 tw-py-2 tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             placeholder="Company Email" v-model="data.email"/>
                      <InputErrorMessage :errors="errors.email"/>
                    </div>
                    <div class="tw-mb-4">
                      <label for="password" class="mt-5">Company Website</label>
                      <input required type="text" name="website" placeholder="website"
                             class="tw-mt-1 tw-px-3 tw-py-2  tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             v-model="data.website"/>
                      <InputErrorMessage :errors="errors.password"/>
                    </div>
                  </div>
                </form>
              </div>

              <div class="tw-mt-4">
                <button
                    class=" tw-text-black tw-border tw-border-gray-600 tw-py-1 hover:tw-bg-black hover:tw-text-white tw-rounded-full tw-px-8 tw-m-2"
                    type="button"
                    :loading="loading" :disabled="loading"> {{ loading ? "Creating Company..." : "Create Company" }}
                </button>
                <button
                    type="button"
                    class="tw-inline-flex tw-justify-center tw-rounded-md tw-border tw-border-transparent tw-bg-red-100 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-blue-900 hover:tw-bg-blue-200 focus:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-blue-500 focus-visible:tw-ring-offset-2"
                    @click="close" >Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>`
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<style scoped>

</style>