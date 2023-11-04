<script setup>
import {ref} from "vue";
import axios from "axios";
import {useAuthStore} from "@/stores/auth";
import InputErrorMessage from "@/components/InputErrorMessage/InputErrorMessage.vue";
import {useRouter} from "vue-router";

const email = ref("")
const password = ref("")
const errors = ref({})
const loading = ref(false)

const authStore = useAuthStore()
const router = useRouter()
const onSubmit = () => {
  loading.value = true;
  const csrf_url = (import.meta.env.VITE_VUE_API_URL || "") + '/sanctum/csrf-cookie';
  errors.value = {}
  axios.get(csrf_url)
      .then(r => {
        axios
            .post("/login", {
              email: email.value,
              password: password.value,
            })
            .then((response) => {
              if (response.status === 200) {
                authStore.login(response.data)
                router.push({name: 'companies'});
              }
            })
            .catch((error) => {
              errors.value = error.response.data.errors
            })
            .finally(() => {
              loading.value = false;
            })
      })
}
</script>

<template>
  <div class="tw-h-[90vh] tw-flex tw-justify-center tw-items-center">
    <div
        class=" tw-w-1/2 group  tw-opacity-75 tw-block tw-mx-auto tw-shadow-lg tw-border tw-border-l-gray-400 tw-p-5 tw-rounded-2xl tw-bg-white  ">
      <h1 class="tw-mb-4 tw-text-2xl tw-font-bold tw-p-4 tw-rounded-2xl ">Login</h1>
      <form @submit.prevent="onSubmit" ref="refVForm">
        <div class="tw-p-4">
          <div class="tw-mb-4">
            <label for="email" class="tw-mt-5">Your Email: *</label>
            <input required type="email" name="email"
                   class="tw-mt-1 tw-px-3 tw-py-2 tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                   placeholder="Email" v-model="email"/>
            <InputErrorMessage :errors="errors.email"/>
          </div>
          <div class="tw-mb-4">
            <label for="password" class="mt-5">Password: *</label>
            <input required type="password" name="password" placeholder="password"
                   class="tw-mt-1 tw-px-3 tw-py-2  tw-border tw-shadow-sm tw-border-slate-300 tw-placeholder-slate-400 tw-focus:outline-none tw-focus:border-sky-500 tw-focus:ring-sky-500 tw-block tw-w-full tw-rounded-md sm:tw-text-sm focus:tw-ring-1"
                   v-model="password"/>
            <InputErrorMessage :errors="errors.password"/>
          </div>
        </div>
        <div class="tw-flex tw-justify-center">
          <button
              class=" tw-text-black tw-border tw-border-gray-600 tw-py-1 hover:tw-bg-black hover:tw-text-white tw-rounded-full tw-px-8 tw-m-2"
              type="submit"
              :loading="loading" :disabled="loading"> {{ loading ? "Signing in..." : "Signin" }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>

</style>