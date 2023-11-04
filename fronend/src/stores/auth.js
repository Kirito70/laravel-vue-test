import {ref, computed, onMounted} from 'vue'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null)
  const token = ref(null)

  onMounted( () => {
    user.value = localStorage.getItem("user") || null
    token.value = localStorage.getItem("token") || null
  })

  function login(data) {
    user.value = data.user
    token.value = data.token
    localStorage.setItem("user", data.user)
    localStorage.setItem("token", data.token)
  }

  return { user, token, login }
})
