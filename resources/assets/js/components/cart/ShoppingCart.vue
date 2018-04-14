<template>
    <!--Wrapper Div-->
    <div
        v-show="cartIsNotEmpty"
        class="bg-white rounded-lg p-3 shadow-lg"
    >
        <!--Shopping Cart-->
        <div class="flex flex-col">
            <!--Header-->
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

            <!--Body-->
            <div
                v-for="product in products"
                :key="product.id"
                class="flex justify-between items-center py-2 my-1 border rounded.lg shadow px-3 text-sm"
            >
                <!--Item Information-->
                <div>
                    <span class="mr-1">{{ product.quantity }}</span>
                    <span class="text-grey-darker">{{ product.name }}</span>
                </div>
                <!--Actions-->
                <div class="inline-flex">
                    <button
                        :class="[! inStock(product) ? 'opacity-50 cursor-not-allowed bg-red text-white hover:bg-transparent hover:text-red' : 'bg-grey-light hover:bg-grey text-grey-darkest hover:text-white' ]"
                        :disabled="! inStock(product)"
                        class="font-bold py-2 px-4 rounded-l"
                        @click="add(product)"
                    >
                        <font-awesome-icon
                            v-if="inStock(product)"
                            :icon="['fal', 'plus']"
                        ></font-awesome-icon>
                        <font-awesome-icon
                            v-else
                            :icon="['far', 'ban']"
                        ></font-awesome-icon>
                    </button>
                    <button
                        class="bg-grey-light hover:bg-grey text-grey-darkest hover:text-white font-bold py-2 px-4 rounded-r"
                        @click="remove(product)"
                    >
                        <font-awesome-icon
                            :icon="['fal', 'minus']"
                        ></font-awesome-icon>
                    </button>
                </div>
            </div>

            <!--Footer-->
            <div class="flex flex-col items-center p-3 border border-b-2 rounded-lg shadow mt-4">
                <!--Checkout Button-->
                <button
                    class="bg-green-light hover:bg-green border-b-4 rounded-lg text-green-darker hover:text-green-darkest px-4 py-2 mb-2"
                    @click="checkout"
                >
                    <font-awesome-icon :icon="['fal', 'credit-card-front']"></font-awesome-icon>
                    <span class="pl-1 font-semibold">Checkout</span>
                </button>
                <!--Total to Pay-->
                <span class="leading-loose text-grey-dark">Total {{ total | currency }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapGetters, mapActions } from 'vuex'

    export default {
        name: "ShoppingCart",

        computed: {
            ...mapState({

            }),

            ...mapGetters('wines', {
                inStock: 'wineIsInStock'
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
                add: 'addProductToCart',
                remove: 'removeProductFromCart',
                checkout: 'checkout'
            })
        }
    }
</script>