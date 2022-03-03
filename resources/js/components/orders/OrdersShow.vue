<template>
    <div class="bg-gray-100">
        <div v-if="order.status == 'PENDING'">
            El pago está pendiente
        </div>
        <dir v-else-if="order.status == 'APPROVED'">

        </dir>
        <div v-else>


        </div>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useOrders from "../../composables/orders";
import { useRoute } from "vue-router";

export default {
    setup() {
        const { order, showOrders } = useOrders();
        const route = useRoute();

        onMounted(showOrders(route.params.reference));

        return {
            order,
        };
    },
};
</script>
