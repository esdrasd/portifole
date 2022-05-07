import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../view/Home.vue'
import Celular from '../view/Celular.vue'
import Game from '../view/Game.vue'
import Notebook from '../view/Notebook.vue'
import Add from '../view/Add.vue'
import Comprar from '../view/Comprar.vue'
import Cart from '../view/Cart.vue'
// import Cart from '../view/Cart2.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/celular', component: Celular },
    { path: '/game', component: Game },
    { path: '/notebook', component: Notebook },
    { path: '/add', component: Add },
    { path: '/comprar/:produtos', component: Comprar, props: true },
    { path: '/cart', component: Cart },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router