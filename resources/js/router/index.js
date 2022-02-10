import { createRouter, createWebHistory } from 'vue-router';

import IndexProducts from './components/products/Index';

const routes = [
    {
        path: '/dashboard',
        name: 'products.index',
        component: IndexProducts,
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})