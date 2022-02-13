<template>
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
                        v-for="product in products"
                        :key="product.id"
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
import useProducts from "../../composables/products";
import useCategories from "../../composables/categories";
import { onMounted } from "vue";

export default {
    setup() {
        const { products, getProducts } = useProducts();
        const { categories, getCategories } = useCategories();

        onMounted(getProducts(), getCategories());

        return {
            products,
            categories
        }
    },
};
</script>
