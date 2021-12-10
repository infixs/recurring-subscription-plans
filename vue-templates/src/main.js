import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './SubscribersApp.vue'
import { createRouter, createWebHashHistory } from 'vue-router'

axios.defaults.baseURL = import.meta.env.VITE_API_BASE_URL + 'wp-json/rsp/v1/'

const routes = [
    { 
        path: '/', 
        component: () => import('./pages/subscribers/Main.vue') 
    },
    { 
        path: '/about', 
        name: 'about',
        component: () => import('./pages/subscribers/About.vue')  
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

createApp(App).use(VueAxios, axios).use(router).mount('#app')
