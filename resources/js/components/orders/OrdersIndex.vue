<template>
    <div class="container flex">
        <div
            class="w-full mx-auto p-6 mb-8 overflow-hidden rounded-lg shadow-lg"
        >
            <h3 v-if="orders.length == 0">
                No has generado nunguna orden hasta el momento.
            </h3>
            <div v-else>
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600"
                        >
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Precio</th>
                            <th class="px-4 py-3">Ver</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr
                            class="text-gray-700"
                            v-for="order in orders"
                            :key="order.id"
                        >
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        <span v-if="order.status == 'PENDING'">Pendiente</span>
                                        <span v-if="order.status == 'APPROVED'">Aprovada</span>
                                        <span v-if="order.status == 'REJECTED'">Rechazada</span>
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ currencyCOP(order.price) }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div
                                    class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                >
                                    <router-link
                                        :to="{
                                            name: 'buyer.orders.show',
                                            params: { reference: order.id },
                                        }"
                                    >
                                        Ver
                                    </router-link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted } from 'vue';
import useOrders from "../../composables/orders";

export default {
    setup() {
        const { orders, indexOrders, retryOrders } = useOrders();

        onMounted(indexOrders());

        return {
            orders,
            retryOrders,
        };
    },

    methods: {

        currencyCOP(value) {
            const options = { style: "currency", currency: "COP" };
            const numberFormat = new Intl.NumberFormat("es-ES", options);

            return numberFormat.format(value);
        },
    },
};
</script>
