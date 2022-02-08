require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Vue = require('vue');

Vue.component('catalog', require('./components/Catalog.vue').default);

const app = new Vue({
    el: '#app',
    
});
