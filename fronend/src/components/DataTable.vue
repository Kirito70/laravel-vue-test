<script setup>
  import Pagination from "@/components/Pagination.vue";

  const props = defineProps({
    data: {
      required: true
    },
    config: {
      required: true
    },
    pagination: {
      required: false
    }
  })

  const emit = defineEmits(['pageChange', 'onEdit', 'onDelete'])

  const pageChanged = (page) => {
    emit('pageChange', page)
  }
</script>

<template>
  <table class="tw-table-auto tw-w-full">
    <thead class="tw-bg-blue-100 tw-opacity-100 tw-p-4">
    <tr>
      <th v-for="col in config.columns">{{ col.label }}</th>
      <th>Action</th>
    </tr>
    </thead>


    <tr v-for="(row,index) in data" :key="`row-${index}`">
      <td v-for="col in config.columns" class="tw-py-2 tw-text-center">
        <template v-if="col.type == 'image'">
          <div v-if="row[col.name]" class="tw-justify-center tw-flex tw-w-full">
            <img class=" tw-h-[50px] tw-w-[50px] tw-rounded-[50%] tw-text-center" alt="logo" :src="row[col.name]">
          </div>
          <p v-else>-</p>
        </template>
        <template v-else>
          {{ row[col.name]?? '-' }}
        </template>
      </td>

      <td class="tw-py-2 tw-text-center">
        <button class="tw-p-2" @click="$emit('onEdit', row)">
          <i class="fa-solid fa-pencil" />
        </button>
        <button class="tw-p-2 tw-text-red-700" @click="$emit('onDelete', row)">
          <i class="fa-solid fa-trash-alt" />
        </button>
      </td>
    </tr>
  </table>

  <pagination v-if="pagination" :pagination="pagination" @change-page="pageChanged" />
</template>

<style scoped>

</style>