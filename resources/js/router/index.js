import { createRouter, createWebHistory } from "vue-router";

import ProductsIndex from "../components/products/ProductsIndex";
import CartIndex from "../components/cart/CartIndex";
import OrdersShow from "../components/orders/OrdersShow";
import OrdersIndex from "../components/orders/OrdersIndex";

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
        path: '/buyer/orders/show/:reference',
        name: 'buyer.orders.show',
        component: OrdersShow,
    },

    {
        path: '/buyer/orders/',
        name: 'buyer.orders.index',
        component: OrdersIndex,
    },

]

export default createRouter({
    history: createWebHistory(),
    routes
})
