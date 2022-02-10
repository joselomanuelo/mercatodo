<template>
    Hello world.
</template>


<!-- <template>
    <div>
        <div class="my-8">
            <div class="container mx-auto px-6">
                <div
                    class="
                        grid
                        gap-6
                        grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-3
                        xl:grid-cols-4
                        mt-6
                    "
                >
                    <div
                        class="
                            w-full
                            max-w-sm
                            mx-auto
                            rounded-md
                            shadow-md
                            overflow-hidden
                        "
                        v-for="(product, index) in products"
                        :key="index"
                    >
                        <div
                            class="
                                flex
                                items-end
                                justify-end
                                h-56
                                w-full
                                bg-cover
                            "
                        >
                            <img
                                :src="'/storage/' + product.product_image"
                                :alt="product.name"
                                @click="viewProduct(product)"
                            />
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">
                                {{ product.name }}
                            </h3>
                            <span class="text-gray-500 mt-2"> 
                                {{ product.price.formatted }}
                            </span>
                            <button></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    el: "#app",
    data() {
        return {
            categories: [],
            products: [],
        };
    },

    mounted() {
        this.loadCategories();
        this.loadProducts();
    },

    methods: {
        loadCategories() {
            axios
                .get("/api/categories")
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        loadProducts() {
            axios
                .get("/api/products")
                .then((response) => {
                    this.products = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        viewProduct(product) {
            this.$swal('Hello');
        }
    },
};
</script> */

<style>
</style>-->