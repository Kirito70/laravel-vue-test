<script setup>

import CompanyTable from "@/views/Companies/CompanyTable.vue";
import EmployeeTable from "@/views/Employees/EmployeeTable.vue";
import {ref} from "vue";

const isActive = ref(false)
</script>

<template>
   <div class="tw-mr-10">
      <nav class="tw-flex tw-justify-end tw-py-2">
      <ul class="tw-font-semibold tw-flex tw-gap-2 ">
        <li class="tw-border tw-border-black tw-px-4 tw-py-1 tw-rounded-[4px] hover:tw-bg-gray-200">
          <router-link to="/dashboard/employee-list" @click="isActive=false">Employees</router-link>
        </li>
        <li class="tw-border tw-border-black tw-px-4 tw-py-1 tw-rounded-[4px]  hover:tw-bg-gray-200">
          <router-link to="/dashboard/company-list" @click="isActive=true">Companies</router-link>
        </li>
      </ul>
    </nav>
   </div>
   <CompanyTable v-if="isActive"/>
  <EmployeeTable v-else />
</template>

<style scoped>

a:hover,
a:active,
a.router-link-active {
  //color: white;
}
</style>