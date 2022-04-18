import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../view/Home.vue'
import Add from '../view/Add.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/add', component: Add },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router