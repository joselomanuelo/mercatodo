require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();


import { createApp } from "vue";
import router from './router'

createApp({}).use(router).mount('#app')
