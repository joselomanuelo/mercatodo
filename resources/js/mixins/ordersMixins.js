export default {
    data() {
        return {
            orders: [],
            shoppingCart: [],
            cartIndexes: [],
            price: 0,
            order: [],
        }
    },

    methods: {
        indexOrders: async (orders) => {
            let response = await axios.get("/api/orders");
            console.table(response);
            orders = response.data.data;
        },
    
        storeOrders: async () => {
            await axios
                .post("/api/orders", {
                    order: JSON.stringify(shoppingCart.map((item) => {
                        return {
                            product_id: item.product_id,
                            price: item.price,
                            amount: item.amount
                        };
                    })),
                    price: price
                })
                .then((response) => {
                    localStorage.removeItem("shoppingCart");
                    window.location.href = response.data.data.process_url;
                });
        },
    
        showOrders: async (reference) => {
            let response = await axios.get("/api/orders/" + reference + "/show");
            order = response.data.data;
        },
    
        retryOrders: async() => {
            await axios
                .post("/api/orders/store", {
                    order_id: order.id
                })
                .then((response) => {
                    window.location.href = response.data.data.process_url;
                });
        },
    
        indexShoppingCart: (shoppingCart) => {
            if (localStorage.getItem("shoppingCart")) {
                shoppingCart = JSON.parse(
                    localStorage.getItem("shoppingCart")
                );
            }
        },
    
        loadCartIndexes: (cartIndexes) => {
            if (localStorage.getItem('shoppingCart')) {
                cartIndexes = JSON.parse(localStorage.getItem('shoppingCart')).map(item => item.product_id);
            }
        },
    }
}