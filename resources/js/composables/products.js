import { ref } from 'vue';
import axios from 'axios' ;

export default function useProducts() {
    const products = ref([]);

    const getProducts = async () => {
        let response = await axios.get("/api/products");
        products.value = response.data.data;
    }
    return {
        products,
        getProducts
    };
}
