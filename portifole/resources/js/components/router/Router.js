import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../view/Home.vue'
import Add from '../view/Add.vue'
import Comprar from '../view/Comprar.vue'
import Cart from '../view/Cart.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/add', component: Add },
    { path: '/comprar/:produtos', component: Comprar, props: true},
    { path: '/cart', component: Cart },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router