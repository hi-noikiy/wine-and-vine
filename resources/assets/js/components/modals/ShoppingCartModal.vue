<template>
    <modal
        v-show="cartIsNotEmpty"
        name="shopping-cart"
        width="90%"
        class="lg:hidden"
        height="auto"
    >
        <!--Shopping Cart-->
        <div class="flex flex-col m-4">
            <!--Header-->
            <div class="flex items-center justify-center py-4 border border-b-2 rounded-lg shadow">
                <span class="text-center mr-2 text-sm lg:text-lg">Shopping Cart</span>
                <span>
                    <font-awesome-icon
                        :icon="['fal', 'shopping-cart']"
                        size="lg"
                    ></font-awesome-icon>
                </span>
                <span
                    v-show="cartIsNotEmpty"
                    class="-mt-6 -ml-3 px-2 py-1 text-xs bg-red hover:bg-red-dark rounded-full cursor-pointer text-white"
                >{{ count }}</span>
            </div>

            <!--Body-->
            <div
                v-for="product in products"
                :key="product.id"
                class="flex justify-between items-center py-2 my-1 border rounded.lg shadow px-3 text-sm"
            >
                <!--Item Information-->
                <div class="text-grey-darker">
                    <span class="mr-1">{{ product.quantity }}</span>
                    <span>{{ product.name }}</span>
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
            <div class="flex flex-col items-center shadow mt-4">
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
    </modal>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "ShoppingCartModal",

        computed: {
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
            }),

            show () {
                this.$modal.show('shopping-cart');
            },
            hide () {
                this.$modal.hide('shopping-cart');
            }
        }
    }
</script>

<style scoped>

</style>