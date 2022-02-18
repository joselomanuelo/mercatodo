<template>
    <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
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
                        <tr class="text-gray-700" v-for="item in shoppingCart" :key="item.id">
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <img :src="'/storage/' + item.product_image"
                                            :alt="item.name">
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ item.name }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ item.description }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ item.amount }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ item.price }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold text-black">
                                        {{ item.price * item.amount }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <button class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Quitar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            shoppingCart: JSON.parse(localStorage.getItem('shoppingCart'))
        }
    },
}
</script>
