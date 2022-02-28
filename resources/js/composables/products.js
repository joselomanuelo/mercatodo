import {ref} from 'vue';
import axios from 'axios' ;

export default function useProducts() {
    const products = ref([]);

    const indexProducts = async () => {
        let token = localStorage.getItem('token');
        let config = {
            headers : {
                'Authorization': 'Bearer ' + token
            }
        }
        let response = await axios.get("/api/products");
        products.value = response.data.data;
    }

    return {
        products,
        indexProducts
    };
}
