<template>
    <div class="container">
        <div class="row">
            <div>
                <div
                    v-if="loading"
                    class="text-center"
                >
                    <span>Loading wines</span>
                    <font-awesome-icon
                        :icon="['fas', 'wine-glass']"
                        :spin="true"
                        :fixed-width="true"
                    />
                </div>

                <div
                    v-else
                    class="card card-default">
                    <div class="card-header">Wines Component</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li
                                v-for="wine in wines"
                                :key="wine.id"
                                class="list-inline mb-3"
                            >
                                <small>{{ wine.quantity_in_stock }} {{ wine.name }}</small>
                                <button
                                    v-if="wineIsInStock(wine)"
                                    type="button"
                                    class="btn btn-sm btn-outline-secondary list-inline-item float-right ml-4"
                                    @click="addWineToCart(wine)"
                                >Add To Cart <font-awesome-icon :icon="['fal', 'cart-plus']" /></button>
                                <button
                                    v-else
                                    :disabled="! wineIsInStock(wine.id)"
                                    type="button"
                                    class="btn btn-sm btn-danger list-inline-item float-right ml-4"
                                >Sold Out <font-awesome-icon :icon="['fal', 'exclamation-circle']" />
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapGetters, mapActions } from 'vuex'

    export default {
        data() {
            return {
                loading: false
            }
        },

        computed: {
            ...mapState({

            }),

            ...mapGetters('wines', {
                wines: 'all',
                wineIsInStock: 'wineIsInStock'
            })
        },

        created () {
            this.loading = true;
            this.fetchWines()
                .then(() => this.loading = false)
        },

        methods: {
            ...mapActions('wines', {
                fetchWines: 'fetchWines'
            }),

            ...mapActions('cart', {
                addWineToCart: 'addProductToCart'
            }),

            // addWineToCart(wine) {
            //     this.$store.dispatch('addWineToCart', wine)
            //         .then(() => this.$notify({
            //             group: 'cart',
            //             title: `Yaaay! <i class="fal fa-user"></i>`,
            //             text: `${wine.name} was added to your cart`,
            //             type: 'success'
            //         }))
            // }
        }
    }
</script>