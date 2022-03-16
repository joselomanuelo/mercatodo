export default {
    data() {
        return {
            categories: []
        }
    },

    methods: {
        indexCategories: async (categories) => {
            let response = await axios.get("/api/categories");
            categories = response.data.data;
        }
    },

    }
