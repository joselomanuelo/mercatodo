import { ref } from "vue";

export default function useCart() {
    const shoppingCart = ref([]);
    const cartIndexes = ref([]);
    
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
        shoppingCart,
        cartIndexes,
        indexShoppingCart,
        loadCartIndexes,
    };
}
