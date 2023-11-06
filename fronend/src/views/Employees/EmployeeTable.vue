<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import DataTable from "@/components/DataTable.vue";
import EmployeeFormModal from "@/components/EmployeeFormModal.vue";

const employees = ref([])
const openDialog = ref(false)
const employeeEdited = ref(null)
const config = ref({
  columns: [
    {
      name: 'id',
      label: 'Id',
      type: 'text'
    },
    {
      name: 'first_name',
      label: 'First Name',
      type: 'text'
    },
    {
      name: 'last_name',
      label: 'Last Name',
      type: 'text'
    },
    {
      name: 'email',
      label: 'Email',
      type: 'text'
    },
    {
      name: 'company',
      label: 'Company',
      type: 'text'
    },
    {
      name: 'phone',
      label: 'Phone',
      type: 'text'
    }
  ],
  pkey: 'id'
})

const getEmployees = (page = 1) => {
  axios.get("/employees", {
    params: {
      page
    }
  }).then((response) => {
    employees.value = response.data
  })
}

const closeModal = () => {
  openDialog.value = false
  employeeEdited.value = null
  getEmployees()
}

const deleteEmployee = () => {

}

const editCompany = (employee) => {
  employeeEdited.value = employee
  openDialog.value = true
}

onMounted(() => {
  getEmployees()
})
</script>

<template>
  <div class="tw tw-block tw-mx-auto tw-shadow-lg tw-border tw-m-4 tw-mt-5 tw-p-5 tw-rounded-2xl ">
    <div class="tw-bg-blue-900  tw-rounded-t-2xl tw-p-4">
      <div class=" tw-p-2 tw-flex tw-justify-between">
        <h1 class=" tw-text-xl tw-text-white tw-font-bold">Employees</h1>

        <button class="tw-p-2 tw-text-white tw-bg-green-700 tw-" @click="openDialog = true">
          <i class="fa-solid fa-plus-circle"/>
          Add Employee
        </button>
      </div>
    </div>

    <data-table
        :config="config"
        :data="employees.data"
        :pagination="employees.meta"
        @page-change="getEmployees"
        @on-delete="deleteEmployee"
        @on-edit="editCompany"
    />

    <employee-form-modal :is-open="openDialog" @close="closeModal" :employee="employeeEdited"/>


  </div>
</template>

<style scoped>
.actionIcons{
  margin-left: 4rem;
}


</style>
