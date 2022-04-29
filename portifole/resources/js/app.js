import bootstrapCSS from 'bootstrap/dist/css/bootstrap.css';
import bootstrapJS from 'bootstrap/dist/js/bootstrap.js';
import { createApp } from 'vue';
import App from './components/App.vue'; // navbar e url
import Router from './components/router/Router.js'; //Rotas_URL e Paginas
import Api from './components/Api_pagseguro/Api.js';


createApp(App)
    .use(bootstrapCSS)
    .use(bootstrapJS)
    .use(Router)
    .use(Api)
    .mount('#app');





