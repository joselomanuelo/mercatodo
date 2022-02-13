import { createRouter, createWebHistory } from 'vue-router';

import ProductsIndex from '../components/products/ProductsIndex';

const routes = [
    {
        path: '/',
        name: 'products.index',
        component: ProductsIndex,
    },

    {
        path: '/dashboard',
        name: 'products.index',
        component: ProductsIndex,
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
