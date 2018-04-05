<template>
    <div>
        <a
            :class="{ 'dropdown-toggle': !empty }"
            class="nav-link"
            href="#"
            role="button"
            data-toggle="modal"
            aria-haspopup="true"
            aria-expanded="false"
            data-target="#cart-modal"
        >
            <font-awesome-icon :icon="['fal', 'shopping-cart']"></font-awesome-icon>
        </a>
        <cart-modal
            title="Your cart"
            :items="products"
        ></cart-modal>
    </div>
</template>

<script>
    import { mapState, mapGetters, mapActions } from 'vuex'
    import CartModal from '../modals/CartModal.vue'

    export default {
        name: "NavbarShoppingCart",

        components: {
            CartModal
        },

        computed: {
            ...mapState({

            }),

            ...mapGetters ('cart', {
                products: 'all',
                total: 'total',
                count: 'count',
                empty: 'empty'
            })
        },

        methods: {
            ...mapActions('cart', {
                removeProductFromCart: 'removeProductFromCart',
                checkout: 'checkout'
            })
        }
    }
</script>

<style scoped>

</style>