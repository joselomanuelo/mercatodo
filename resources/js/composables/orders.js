import { reactive, ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default function useOrders() {
    const orders = ref([]);
    const shoppingCart = ref([]);
    const router = useRouter();
    const order = ref({
        price: 0,
        quantities: {}
    });

    const indexOrders = async () => {
        let token = localStorage.getItem('token');
        let config = {
            headers : {
                'Authorization': 'Bearer ' + token
            }
        }
        let response = await axios.get('/api/orders');
        orders.value = response.data.data;
    }

    const storeOrders = async () => {
        let token = localStorage.getItem('token');
        let config = {
            headers : {
                'Authorization': 'Bearer ' + token
            }
        }
        await axios.post('/api/orders', {
            orders: JSON.stringify(order.value),
            user_id: localStorage.getItem('user_id')
        }, config);

        await router.push({ name: 'buyer.cart.index' });
    }

    return {
        orders,
        order,
        shoppingCart,
        indexOrders,
        storeOrders
    };
}
