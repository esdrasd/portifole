import { createApp } from 'vue'
import App from './components/App.vue'
import Router from './components/router/Router.js'

createApp(App)
    .use(Router)
    .mount('#app');