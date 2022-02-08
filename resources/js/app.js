require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import Catalog from './components/Catalog';
const app = createApp({});
app.component('catalog-page', Catalog);
app.mount('#app');