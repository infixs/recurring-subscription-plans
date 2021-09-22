import { createApp } from 'vue'
import App from './SubscribersApp.vue'

import { createRouter, createWebHashHistory } from 'vue-router'

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

createApp(App).use(router).mount('#app')
