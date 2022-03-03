import { createRouter, createWebHistory } from "vue-router";

import ProductsIndex from "../components/products/ProductsIndex";
import CartIndex from "../components/cart/CartIndex";
import OrdersShow from "../components/orders/OrdersShow";

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

]

export default createRouter({
    history: createWebHistory(),
    routes
})
