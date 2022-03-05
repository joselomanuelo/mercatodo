<template>
    <div class="bg-gray-100">
        <div v-if="order.status == 'PENDING'">
            El proceso de pago está pendiente, te estaremos avisando por correo
            cuando el pago esté tramitado.
        </div>
        <div v-else-if="order.status == 'APPROVED'">
            El pago fue aprovado, tu pedido está en camino.
        </div>
        <div v-else-if="order.status == 'REJECTED'">
            <div>El pago fue rechazado, te invitamos a que reintentes el pago.</div>
            <button
                class="justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                @click="retryPayment()"
            >
                Reintentar Pago
            </button>
        </div>
        <div v-else>
            La orden no cargó
        </div>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useOrders from "../../composables/orders";
import { useRoute } from "vue-router";

export default {
    setup() {
        const { order, showOrders, retryOrders } = useOrders();
        const route = useRoute();

        const retryPayment = async () => {
            await retryOrders();
        };

        onMounted(showOrders(route.params.reference));

        return {
            order,
            retryPayment
        };
    },
};
</script>
