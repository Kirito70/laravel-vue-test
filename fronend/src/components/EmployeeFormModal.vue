<script setup>
import {ref, watch} from 'vue'
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionRoot,
  TransitionChild
} from '@headlessui/vue'
import InputErrorMessage from "@/components/InputErrorMessage/InputErrorMessage.vue";

const props = defineProps({
  isOpen: {
    required: true
  },
  employee: {
    required: false
  }
})

const errors = ref({})
const loading = ref(false)
const data = ref({
  first_name: '',
  last_name: '',
  email: '',
  website: '',
  company_id: '',
})

const emits = defineEmits([
  'close'
])

watch(() => props.isOpen, (old, newValue) => {
  if (props.employee) {
    data.value.first_name = props.employee.first_name
    data.value.email = props.employee.email
    data.value.phone = props.employee.phone
    data.value.company_id = props.employee.company_id
    data.value.last_name = props.employee.last_name
  }
})

function close() {
  emits('close')
}

const createEmployee = () => {
  errors.value = {}
  let url = '/employees'

  if (props.employee) {
    url += '/' + props.employee.id

    data.value['_method'] = 'PATCH'
  }

  let formData = new FormData()

  Object.keys(data.value).forEach(key => {
    console.log(key)
    formData.append(key, data.value[key])
  })

  axios.post(url, formData).then(response => {
    emits('close')
    resetForm()
  }).catch(error => {
    errors.value = error.response.data.errors
  })
}

const resetForm = () => {
  data.value = {
    name: '',
    email: '',
    logo: '',
    website: ''
  }
  errors.value = {}
}

const fileSelected = (event) => {
  data.value.logo = event.target.files[0]
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
              >{{ `${employee ? "Edit" : "Create"} Employee` }}</DialogTitle>

              <div class="tew-mt-3">
                <form @submit.prevent="createEmployee" enctype="multipart/form-data">
                  <div class="tw-p-4">
                    <div class="tw-mb-4">
                      <label for="email" class="tw-mt-5">Employee First Name</label>
                      <input required type="text" name="first_name"
                             class="tw-mt-1 tw-px-3 tw-py-2 tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             placeholder="First Name" v-model="data.first_name"/>
                      <InputErrorMessage :errors="errors.first_name"/>
                    </div>
                    <div class="tw-mb-4">
                      <label for="email" class="tw-mt-5">Employee Last Name</label>
                      <input required type="text" name="last_name"
                             class="tw-mt-1 tw-px-3 tw-py-2 tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             placeholder="Last Name" v-model="data.last_name"/>
                      <InputErrorMessage :errors="errors.last_name"/>
                    </div>
                    <div class="tw-mb-4">
                      <label for="email" class="tw-mt-5">Employee Email</label>
                      <input required type="email" name="email"
                             class="tw-mt-1 tw-px-3 tw-py-2 tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             placeholder="Employee Email" v-model="data.email"/>
                      <InputErrorMessage :errors="errors.email"/>
                    </div>
                    <div class="tw-mb-4">
                      <label for="phone" class="mt-5">Employee Website</label>
                      <input type="text" name="phone" placeholder="Phone"
                             class="tw-mt-1 tw-px-3 tw-py-2  tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                             v-model="data.phone"/>
                      <InputErrorMessage :errors="errors.phone"/>
                    </div>
                  </div>
                </form>
              </div>

              <div class="tw-mt-3 tw-flex tw-justify-between">
                <button
                    type="button"
                    class="tw-inline-flex tw-justify-center tw-rounded-md tw-border tw-border-transparent tw-bg-red-100 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-blue-900 hover:tw-bg-blue-200 focus:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-blue-500 focus-visible:tw-ring-offset-2"
                    @click="close" >Cancel</button>
                <button
                    class="tw-inline-flex tw-justify-center tw-rounded-md tw-border tw-border-transparent tw-bg-green-100 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-blue-900 hover:tw-bg-blue-200 focus:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-blue-500 focus-visible:tw-ring-offset-2"
                    type="button"
                    @click="createEmployee"
                    :loading="loading" :disabled="loading"> {{ loading ? "Creating Employee..." :  `${employee ? "Edit" : "Create"} Employee` }}
                </button>
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