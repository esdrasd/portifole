import bootstrapCSS from 'bootstrap/dist/css/bootstrap.css';
import bootstrapJS from 'bootstrap/dist/js/bootstrap.js';
import { createApp } from 'vue';
import Api from './components/Api_pagseguro/Api.js';
import App from './components/App.vue'; // navbar e url
import App_ii from './components/App_ii.vue'; // navbar e url
import Router from './components/router/Router.js'; //Rotas_URL e Paginas



createApp(App)
    .use(bootstrapCSS)
    .use(bootstrapJS)
    .use(Router)
    .use(Api)
    .mount('#app');

createApp(App_ii)    
    .mount('#app2')