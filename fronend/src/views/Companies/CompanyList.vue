<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import DataTable from "@/components/DataTable.vue";
import CompanyFormModal from "@/components/CompanyFormModal.vue";

const companies = ref([])
const openDialog = ref(false)
const companyEdited = ref(null)
const config = ref({
  columns: [
    {
      name: 'id',
      label: 'Id',
      type: 'text'
    },
    {
      name: 'name',
      label: 'Company Name',
      type: 'text'
    },
    {
      name: 'email',
      label: 'Email',
      type: 'text'
    },
    {
      name: 'logo',
      label: 'Logo',
      type: 'image'
    },
    {
      name: 'website',
      label: 'Website',
      type: 'text'
    }
  ],
  pkey: 'id'
})

const getCompanies = (page = 1) => {
  axios.get("/companies", {
    params: {
      page
    }
  }).then((response) => {
    companies.value = response.data
  })
}

const closeModal = () => {
  openDialog.value = false
  companyEdited.value = null
  getCompanies()
}

const deleteCompany = () => {

}

const editCompany = (company) => {
  companyEdited.value = company
  openDialog.value = true
}

onMounted(() => {
  getCompanies()
})
</script>


<template>
  <div class="tw tw-block tw-mx-auto tw-shadow-lg tw-border tw-m-4 tw-mt-5 tw-p-5 tw-rounded-2xl ">
    <div class="tw-bg-blue-900  tw-rounded-t-2xl tw-p-4">
      <div class=" tw-p-2 tw-flex tw-justify-between">
        <h1 class=" tw-text-xl tw-text-white tw-font-bold">Company</h1>

        <button class="tw-p-2 tw-text-white tw-bg-green-700 tw-" @click="openDialog = true">
          <i class="fa-solid fa-plus-circle"/>
          Add Company
        </button>
      </div>
    </div>

    <data-table
        :config="config"
        :data="companies.data"
        :pagination="companies.meta"
        @page-change="getCompanies"
        @on-delete="deleteCompany"
        @on-edit="editCompany"
    />

    <company-form-modal :is-open="openDialog" @close="closeModal" :company="companyEdited"/>


  </div>
</template>
