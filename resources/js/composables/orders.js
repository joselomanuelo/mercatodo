import { ref } from "vue";
import axios from "axios";

export default function useOrders() {
    const orders = ref([]);
    const shoppingCart = ref([]);
    const cartIndexes = ref([]);
    const price = ref(0);
    const order = ref({});


    const indexOrders = async () => {
        let response = await axios.get("/api/orders");
        orders.value = response.data.data;
    };

    const storeOrders = async () => {
        await axios
            .post("/api/orders", {
                order: JSON.stringify(shoppingCart.value.map((item) => {
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
                window.location.href = response.data.data.process_url;
            });
    };

    const showOrders = async (reference) => {
        let response = await axios.get("/api/orders/" + reference + "/show");
        order.value = response.data.data;
    };

    const retryOrders = async() => {
        await axios
            .post("/api/orders/retry", {
                order_id: order.value.id
            })
            .then((response) => {
                window.location.href = response.data.data.process_url;
            });
    };

    const indexShoppingCart = () => {
        if (localStorage.getItem("shoppingCart")) {
            shoppingCart.value = JSON.parse(
                localStorage.getItem("shoppingCart")
            );
        }
    };

    const loadCartIndexes = () => {
        if (localStorage.getItem('shoppingCart')) {
            cartIndexes.value = JSON.parse(localStorage.getItem('shoppingCart')).map(item => item.product_id);
        }
    };

    return {
        order,
        orders,
        shoppingCart,
        cartIndexes,
        price,
        indexShoppingCart,
        loadCartIndexes,
        indexOrders,
        storeOrders,
        showOrders,
        retryOrders,
    };
}
