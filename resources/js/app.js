require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();


import { createApp } from "vue";
import router from './router'
import ProductsIndex from './components/products/ProductsIndex'
createApp({
    components: {
        ProductsIndex
    }
}).use(router).mount('#app')

/* import { createApp } from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Index from './components/products/Index';
const app = createApp({});
app.use(VueSweetalert2);
app.component('index-page', Index);
app.mount('#app');
 */

/* import Vue from 'vue';
window.Vue = Vue;

import App from './components/App';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';
import { routes } from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h = h(App)
}); */
