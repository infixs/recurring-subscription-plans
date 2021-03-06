import { createApp } from 'vue'
import App from './pages/Subscribers.vue'

import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
    { 
        path: '/', 
        component: () => import('./pages/Subscribers.vue') 
    },
    { 
        path: '/about', 
        name: 'about',
        component: () => import('./pages/Subscribers.vue')  
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

createApp(App).use(router).mount('#app')
