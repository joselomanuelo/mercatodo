import { ref } from "vue";
import axios from "axios";

export default function useOrders() {
    const orders = ref([]);
    const price = ref(0);
    const order = ref({});


    const indexOrders = async () => {
        let response = await axios.get("/api/orders");
        orders.value = response.data.data;
    };

    const storeOrders = async (shoppingCart) => {
        await axios
            .post("/api/orders", {
                order: JSON.stringify(shoppingCart.map((item) => {
                    return {
                        product_id: item.product_id,
                        price: item.price,
                        amount: item.amount
                    };
                })),
                price: price.value
            })
            .then((response) => {
                localStorage.removeItem("shoppingCart");
                localStorage.setItem('order_id', response.data.data.id);
                window.location.href = response.data.data.process_url;
            });
    };

    const showOrders = async (reference) => {
        let response = await axios.get("/api/orders/" + reference + "/show");
        localStorage.setItem('order_id', response.data.data.id);
        order.value = response.data.data;
    };

    const retryOrders = async() => {
        await axios
            .post("/api/orders", {
                order_id: order.value.id
            })
            .then((response) => {
                localStorage.setItem('order_id', response.data.data.id);
                window.location.href = response.data.data.process_url;
            });
    };

    return {
        order,
        orders,
        price,
        indexOrders,
        storeOrders,
        showOrders,
        retryOrders,
    };
}
