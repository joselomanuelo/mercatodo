import { createRouter, createWebHistory } from 'vue-router';

import ProductsIndex from '../components/products/ProductsIndex';
import CartIndex from "../components/cart/CartIndex";

const routes = [
    {
        path: '/',
        name: 'products.index.home',
        component: ProductsIndex,
    },

    {
        path: '/dashboard',
        name: 'products.index.dashboard',
        component: ProductsIndex,
    },

    {
        path: '/buyer/cart',
        name: 'buyer.cart.index',
        component: CartIndex,
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
