import { reactive, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useOrders() {
    const orders = ref([]);
    const shoppingCart = ref([]);
    const router = useRouter();
    const order = ref({
        price: 0,
        quantities: {},
    });

    const indexOrders = async () => {
        
        let response = await axios.get("/api/orders");
        orders.value = response.data.data;
    };

    const storeOrders = async () => {
        await axios
            .post("/api/orders", {
                orders: JSON.stringify(order.value),

            })
            .then((response) => {
                localStorage.removeItem("shoppingCart");
                window.location.href = response.data.data.process_url;
            });
    };

    return {
        orders,
        order,
        shoppingCart,
        indexOrders,
        storeOrders,
    };
}
