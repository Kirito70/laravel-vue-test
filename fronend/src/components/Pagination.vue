<script setup>

const props = defineProps({
  pagination: {
    required: true
  }
})

const emit = defineEmits(['changePage'])

const previousPage = () => {
  emit('changePage', props.pagination.current_page - 1)
}

const nextPage = () => {
  emit('changePage', props.pagination.current_page + 1)
}

const selectPage = (page) => {
  emit('changePage', page)
}

</script>

<template>
  <div class="tw-flex tw-items-center tw-justify-between tw-border-t tw-border-gray-200 tw-bg-white tw-px-4 tw-py-3 tw-sm:px-6">
    <div class="tw-hidden sm:tw-flex sm:tw-flex-1 sm:tw-items-center sm:tw-justify-between">
      <div>
        <p class="tw-text-sm tw-text-gray-700">
          Showing
          {{ ' ' }}
          <span class="tw-font-medium">{{ pagination.from }}</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="tw-font-medium">{{ pagination.to }}</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="tw-font-medium">{{ pagination.total }}</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div>
        <nav class="tw-isolate tw-inline-flex tw-space-x-px tw-rounded-md tw-shadow-sm" aria-label="Pagination">
          <button
              href="#"
              class="tw-relative tw-inline-flex tw-items-center tw-rounded-l-md tw-px-2 tw-py-2 tw-text-gray-400 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0"
              :class="{
                'tw-cursor-not-allowed': pagination.current_page <= 1
              }"
              :disabled="pagination.current_page <= 1"
              @click="previousPage"
          >
<!--            <span class="sr-only">Previous</span>-->
            <i class="fa-solid fa-chevron-left"/>
<!--            <ChevronLeftIcon class="tw-h-5 tw-w-5" aria-hidden="true" />-->
          </button>
          <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
          <button v-for="page_no in pagination.last_page" href="#" aria-current="page"
             class="tw-relative tw-z-10 tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-text-sm tw-font-semibold focus:tw-z-20 focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-2"
             :class="{
              'tw-bg-indigo-600': page_no === pagination.current_page,
              'tw-text-white': page_no === pagination.current_page,
              'focus-visible:tw-outline-indigo-600': page_no === pagination.current_page,
             }"
            @click="selectPage(page_no)"
          >
            {{ page_no }}
          </button>
          <button
              href="#"
              class="tw-relative tw-inline-flex tw-items-center tw-rounded-r-md tw-px-2 tw-py-2 tw-text-gray-400 tw-ring-1 tw-ring-inset tw-ring-gray-300 hover:tw-bg-gray-50 focus:tw-z-20 focus:tw-outline-offset-0"
              :class="{
                'tw-cursor-not-allowed': pagination.current_page >= pagination.last_page
              }"
              :disabled="pagination.current_page >= pagination.last_page"
              @click="nextPage"
          >
<!--            <span class="sr-only">Next</span>-->
            <i class="fa-solid fa-chevron-right"/>
<!--            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />-->
          </button>
        </nav>
      </div>
    </div>
  </div>
</template>