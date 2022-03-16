export default {
    data() {
        return {
            products: []
        }
    },

    methods: {
        indexProducts: async (products) => {
            let response = await axios.get("/api/products");
            products = response.data.data;
        }
    },

    
}
