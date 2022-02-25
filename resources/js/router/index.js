import { createRouter, createWebHistory } from "vue-router";

import ProductsIndex from "../components/products/ProductsIndex";
import CartIndex from "../components/cart/CartIndex";
import Login from "../components/auth/Login"

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
    },

    {
        path: '/api/login',
        name: 'auth.login',
        component: Login,
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
