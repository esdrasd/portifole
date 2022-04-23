import { createApp } from 'vue';
import Api from './components/Api_pagseguro/Api.js';
import App from './components/App.vue'; // navbar e url
import Router from './components/router/Router.js'; //Rotas_URL e Paginas

createApp(App)
    .use(Router)
    .use(Api)
    .mount('#app');





