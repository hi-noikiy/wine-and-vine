<template>
    <div class="row">
        <!--Loading-->
        <div
            v-if="loading"
            class="col text-center"
        >
            <h4 class="text-muted">Loading wines... <font-awesome-icon class="text-danger" :icon="['fas', 'wine-glass']" spin /></h4>
        </div>
        <!--Errors-->
        <div
            v-if="errors"
            class="mx-auto text-danger"
        >
            <p v-for="error in errors">{{ error }}</p>
        </div>

        <!--Wine List-->
        <div
            v-for="wine in wines"
            :key="wine.id"
            class="col-xs-12 col-sm-6 col-lg-4 col-xl-3 mb-4"
        >
            <div class="card">
                <img
                    :src="wine.thumbnailCover"
                    :alt="wine.name"
                    class="card-img-top"
                >
                <div class="card-body">
                    <h5>
                        <a
                            :href="route('wine.show', wine.slug)"
                            class="card-title"
                        >{{ wine.name }}</a>
                    </h5>
                    <p class="card-text text-truncate">{{ wine.description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><small>Price</small> {{ wine.price }}</li>
                    <li class="list-group-item"><small>Region</small> {{ wine.region.name }}</li>
                    <li class="list-group-item">
                        <small>Country</small>
                        <span
                            :class="countryFlag(wine)"
                            class="flag-icon"
                        ></span>
                        {{ wine.winery.country_name }}
                    </li>
                    <li class="list-group-item"><small>Average Rating</small> {{ wine.rating }}</li>
                    <li class="list-group-item"><small>Year</small> {{ wine.year }}</li>
                </ul>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <button
                                class="btn btn-sm btn-outline-info p-1 m-1"
                            >Add to Wishlist</button>
                        </div>
                        <div class="col text-center">
                            <button
                                v-if="! wineIsInStock(wine)"
                                class="btn btn-sm btn-danger p-1 m-1"
                                disabled
                            >Sold Out!</button>
                            <button
                                v-else
                                class="btn btn-sm btn-outline-success p-1 m-1"
                                @click.prevent="addWineToCart(wine)"
                            >Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex'

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
                wineIsInStock: 'wineIsInStock',
                errors: 'errors'
            }),
        },

        created() {
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

            countryFlag(wine) {
                return `flag-icon-${wine.winery.country.cca2.toLowerCase()}`
            }
        }
    }
</script>