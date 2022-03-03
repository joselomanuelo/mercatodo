<template>
    <div>
        <div
            class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
        >
            <router-link :to="{ name: 'buyer.cart.index' }">
                Carrito ({{ shoppingCart.length }})</router-link
            >
        </div>
        <div class="my-8">
            <div class="container mx-auto px-6">
                <div
                    class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6"
                >
                    <div
                        class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden bg-gray-100"
                        v-for="product in products"
                        :key="product.id"
                    >
                        <div
                            class="flex items-end justify-end h-56 w-full bg-cover"
                        >
                            <img
                                :src="'/storage/' + product.product_image"
                                :alt="product.name"
                            />
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">
                                {{ product.name }}
                            </h3>
                            <span class="text-gray-500 mt-2">
                                {{ currencyCOP(product.price) }} </span
                            ><br />
                            <button
                                v-if="!cartIndexes.includes(product.id)"
                                class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                @click="addProductToCart(product)"
                            >
                                Añadir al carrito
                            </button>
                            <span v-else> Añadido al carrito </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useProducts from "../../composables/products";
import useCategories from "../../composables/categories";
import useOrders from "../../composables/orders";
import { onMounted } from "vue";
import Swal from "sweetalert2";

export default {
    setup() {
        const { products, indexProducts } = useProducts();
        const { categories, indexCategories } = useCategories();
        const {
            shoppingCart,
            indexShoppingCart,
            cartIndexes,
            loadCartIndexes,
        } = useOrders();

        onMounted(
            indexProducts(),
            indexCategories(),
            indexShoppingCart(),
            loadCartIndexes()
        );

        return {
            cartIndexes,
            shoppingCart,
            products,
            categories,
            loadCartIndexes,
        };
    },

    methods: {
        addProductToCart(product) {
            Swal.fire({
                title: "¿Quieres añadir " + product.name + " al carrito?",
                imageUrl: "/storage/" + product.product_image,
                input: "range",
                inputLabel: "¿Cuántas unidades deseas añadir?",
                inputAttributes: {
                    min: 1,
                    max: product.stock > 100 ? 100 : product.stock,
                    step: 1,
                },
                inputValue: 1,
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Agregar",
                confirmButtonColor: "#1e40af",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.shoppingCart.push({
                        id: product.id,
                        name: product.name,
                        description: product.description,
                        product_image: product.product_image,
                        amount: result.value,
                        price: product.price,
                    });
                    const parsed = JSON.stringify(this.shoppingCart);
                    localStorage.setItem("shoppingCart", parsed);
                    Swal.fire({
                        title: "!Añadido al carrito!",
                        icon: "success",
                        confirmButtonColor: "#1e40af",
                    });
                    this.loadCartIndexes();
                }
            });
        },
    
        currencyCOP(value) {
            const options = { style: "currency", currency: "COP" };
            const numberFormat = new Intl.NumberFormat("es-ES", options);

            return numberFormat.format(value);
        },
    },
};
</script>
