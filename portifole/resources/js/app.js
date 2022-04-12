import { createApp } from "vue";
import App from './components/App.vue'
import Router from './components/Router/Router.js'

createApp(App)
    .use(Router)
    .mount('#app')