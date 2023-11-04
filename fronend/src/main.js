import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import axios from "axios";
import {useAuthStore} from "@/stores/auth";
import '/node_modules/@fortawesome/fontawesome-free/css/all.min.css';

// import { library } from '@fortawesome/fontawesome-svg-core'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
// import { faPlus } from '@fortawesome/free-solid-svg-icons'
// library.add(faPlus)

const store = createPinia();

// const authStore = useAuthStore()
axios.defaults.baseURL = import.meta.env.VITE_VUE_APP_API_ENDPOINT;
axios.defaults.withCredentials = true;
axios.defaults.headers.common['Access-Control-Allow-Credentials'] = true
axios.defaults.headers.common['Accept'] = 'application/json'

axios.interceptors.request.use( async (config) => {

    if (localStorage.getItem('token')) {
        config.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
    }

    return config;
}, function (error) {
    return Promise.reject(error);
});

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const app = createApp(App)
app.use(store)
app.use(router)
// app.component('font-awesome-icon', FontAwesomeIcon)

app.mount('#app')
