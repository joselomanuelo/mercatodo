import { ref } from 'vue';
import axios from 'axios' ;

export default function useCategories() {
    const categories = ref([]);

    const indexCategories = async () => {
        let token = localStorage.getItem('token');
        let config = {
            headers : {
                'Authorization': 'Bearer ' + token
            }
        }
        let response = await axios.get("/api/categories");
        categories.value = response.data.data;
    }
    return {
        categories,
        indexCategories
    };
}
