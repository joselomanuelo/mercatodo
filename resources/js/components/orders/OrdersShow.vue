<template>
    <div>{{ orderPayed }}</div>
</template>
<script>
import useOrders from "../../composables/orders";

export default {
    setup() {
        const { orderPayed } = useOrders();

        return {
            orderPayed,
        };
    },
};
</script>
