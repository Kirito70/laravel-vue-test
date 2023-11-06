<script setup>

import {ref} from "vue";

</script>

<template>
  <header class="tw-bg-white">
    <nav class="tw-mx-auto tw-flex tw-max-w-7xl tw-items-center tw-justify-between tw-p-6 lg:tw-px-8" aria-label="Global">
      <router-link :to="{name: 'companies'}" class="tw-text-sm tw-font-semibold tw-leading-6 tw-text-gray-900">Companies</router-link>
      <router-link :to="{name: 'employees'}" class="tw-text-sm tw-font-semibold tw-leading-6 tw-text-gray-900">Employees</router-link>
    </nav>
  </header>
  <router-view/>
</template>

<style scoped>

a:hover,
a:active,
a.router-link-active {
  //color: white;
}
</style>