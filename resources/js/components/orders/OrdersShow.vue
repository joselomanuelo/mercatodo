<template>
    <div class="bg-gray-100">
        <div v-if="order.status == 'PENDING'">
            <h2>
                El proceso de pago está pendiente, te estaremos avisando por correo
                cuando el pago esté tramitado.
            </h2>
        </div>
        <div v-else-if="order.status == 'APPROVED'">
            <h2>
                El pago fue aprobado, tu pedido está en camino.
            </h2>
        </div>
        <div v-else-if="order.status == 'REJECTED'">
            <h2>
                El pago fue rechazado, te invitamos a que reintentes el pago.
            </h2> 
            <button
                class=" my-4 justify-center inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
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
import Swal from "sweetalert2";


export default {
    setup() {
        const { order, showOrders, retryOrders } = useOrders();

        const retryPayment = async () => {
            Swal.fire({
                title: "¿Desea realizar el pago?",
                confirmButtonText: "Si",
                confirmButtonColor: "#1e40af",
                showCancelButton: true,
                cancelButtonText: "No",
                cancelButtonColor: "#dc2626",
            }).then((result) => {
                if (result.isConfirmed) {
                    retryOrders();
                }
            });
        };

        onMounted(showOrders(localStorage.getItem('order_id')));

        return {
            order,
            retryPayment
        };
    },
};
</script>
