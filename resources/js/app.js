require('./bootstrap');

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();


import { createApp } from "vue";
import ProductsIndex from './components/products/ProductsIndex';
import CartIndex from './components/cart/CartIndex';
import OrderIndex from './components/orders/OrdersIndex';
import OrderShow from './components/orders/OrdersShow';

const app = createApp({});

app.component('cart-index', CartIndex);
app.component('product-index', ProductsIndex);
app.component('order-index', OrderIndex);
app.component('order-show', OrderShow);

app.mount('#app');
