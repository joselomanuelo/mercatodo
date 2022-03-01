<template>
    <div class="container flex">
        <div
            class="w-full mx-auto p-6 mb-8 overflow-hidden rounded-lg shadow-lg"
        >
            <h3 v-if="shoppingCart.length == 0">El carrito está vacío.</h3>
            <div v-else>
                <h1>El precio total de la orden es: {{ total() }}</h1>
                <button
                    class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                    @click="payOrder(shoppingOrder)"
                >
                    Pagar
                </button>
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600"
                        >
                            <th class="px-4 py-3">Imagen</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Cantidad</th>
                            <th class="px-4 py-3">Precio unitario</th>
                            <th class="px-4 py-3">Precio total</th>
                            <th class="px-4 py-3">Quitar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr
                            class="text-gray-700"
                            v-for="product in shoppingCart"
                            :key="product.id"
                        >
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <img
                                        :src="
                                            '/storage/' + product.product_image
                                        "
                                        :alt="product.name"
                                    />
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ product.name }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ product.description }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <input
                                        v-model="product.amount"
                                        type="number"
                                        class="font-semibold text-black"
                                    />
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ currencyCOP(product.price) }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{
                                            currencyCOP(
                                                product.price * product.amount
                                            )
                                        }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <button
                                        class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        @click="removeProductFromCart(product)"
                                    >
                                        Quitar
                                    </button>
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
import useOrders from "../../composables/orders";
import Swal from "sweetalert2";
import { onMounted } from "vue";

export default {
    setup() {
        const { shoppingCart, price, storeOrders, indexShopingCart } =
            useOrders();

        const payOrder = async () => {
            await storeOrders();
        };

        onMounted(indexShopingCart);

        return {
            price,
            shoppingCart,
            payOrder,
        };
    },

    methods: {
        removeProductFromCart(product) {
            Swal.fire({
                title: "¿Quitar " + product.name + " del carrito?",
                imageUrl: "/storage/" + product.product_image,
                confirmButtonText: "Si",
                confirmButtonColor: "#1e40af",
                showCancelButton: true,
                cancelButtonText: "No",
                cancelButtonColor: "#dc2626",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.shoppingCart = this.shoppingCart.filter(
                        (item) => item.id !== product.id
                    );
                    const parsed = JSON.stringify(this.shoppingCart);
                    localStorage.setItem("shoppingCart", parsed);
                }
            });
        },

        total() {
            this.price = 0;
            this.shoppingCart.forEach((product) => {
                this.price += product.price * product.amount;
            });

            return this.currencyCOP(this.price);
        },

        currencyCOP(value) {
            const options = { style: "currency", currency: "COP" };
            const numberFormat = new Intl.NumberFormat("es-ES", options);

            return numberFormat.format(value);
        },
    },
};
</script>
