<template>
    <div
        v-show="cartIsNotEmpty"
        class="bg-white rounded-lg p-3 shadow-lg"
    >
        <div class="flex flex-col">
            <div class="flex items-center justify-center py-4 border border-b-2 rounded-lg shadow mb-4">
                <span class="text-center mr-2 text-sm lg:text-lg">Shopping Cart</span>
                <span>
                    <font-awesome-icon
                        :icon="['fal', 'shopping-cart']"
                        size="lg"
                    ></font-awesome-icon>
                </span>
                <span
                    v-show="cartIsNotEmpty"
                    class="-ml-3 -mt-8 align-top px-2 py-1 bg-red hover:bg-red-dark border-2 border-solid border-white rounded-full text-white"
                >{{ count }}</span>
            </div>
            <div
                v-for="product in products"
                :key="product.id"
                class="flex flex-col items-center py-2 my-1 border rounded.lg shadow"
            >
                <span class="text-grey-darker">{{ product.name }}</span>
            </div>
        </div>
    </div>
    <!--<div v-if="count !== 0">-->
        <!--<div class="card card-default position-fixed" style="width: 18rem">-->
            <!--<div class="card-header">-->
                <!--<span class="badge badge-primary">{{ count }}</span>-->
                <!--Shopping Cart-->
                <!--<font-awesome-icon :icon="['fal', 'shopping-cart']" />-->
            <!--</div>-->
            <!--<div class="card-body">-->
                <!--<ul class="list-group">-->
                    <!--<li-->
                        <!--v-for="product in products"-->
                        <!--:key="product.id"-->
                        <!--class="list-inline mb-3"-->
                    <!--&gt;-->
                        <!--<small>{{ product.quantity }} {{ product.name }}</small>-->
                        <!--<button-->
                            <!--type="button"-->
                            <!--class="close"-->
                            <!--aria-label="Close"-->
                            <!--@click="removeProductFromCart(product)"-->
                        <!--&gt;<span aria-hidden="true">&times;</span></button>-->
                    <!--</li>-->
                <!--</ul>-->
                <!--<p class="text-info">Total {{ total | currency }}</p>-->
                <!--<button-->
                    <!--class="btn btn-outline-success"-->
                    <!--@click="checkout"-->
                <!--&gt;Checkout</button>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    import { mapState, mapGetters, mapActions } from 'vuex'

    export default {
        name: "ShoppingCart",

        computed: {
            ...mapState({

            }),

            ...mapGetters ('cart', {
                products: 'all',
                total: 'total',
                count: 'count',
                empty: 'empty'
            }),

            cartIsNotEmpty() {
                return ! this.empty
            }
        },

        methods: {
            ...mapActions('cart', {
                removeProductFromCart: 'removeProductFromCart',
                checkout: 'checkout'
            })
        }
    }
</script>