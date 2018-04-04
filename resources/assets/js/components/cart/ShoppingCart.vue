<template>
    <div v-if="count !== 0">
        <div class="card card-default">
            <div class="card-header">
                <small>Shopping Cart
                    <font-awesome-icon :icon="['fal', 'shopping-cart']" />
                    <span class="badge badge-light">{{ count }}</span>
                </small>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li
                        v-for="product in products"
                        :key="product.id"
                        class="list-inline mb-3"
                    >
                        <small>{{ product.quantity }} {{ product.name }}</small>
                        <button
                            type="button"
                            class="close"
                            aria-label="Close"
                            @click="removeProductFromCart(product)"
                        ><span aria-hidden="true">&times;</span></button>
                    </li>
                </ul>
                <p class="text-info">Total {{ total | currency }}</p>
                <button
                    class="btn btn-outline-success"
                    @click="checkout"
                >Checkout</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapGetters, mapActions } from 'vuex'

    export default {
        computed: {
            ...mapState({

            }),

            ...mapGetters ('cart', {
                products: 'all',
                total: 'total',
                count: 'count'
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