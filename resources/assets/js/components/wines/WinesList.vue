<template>
    <div>
        <!--Loading-->
        <div class="flex justify-center">
            <div
                v-if="loading"
                class="bg-white text-center shadow-lg rounded-full px-4 py-1 border text-red-darker hover:text-white hover:bg-red-darker"
            >
                <span class="text-xs font-semibold leading-loose ">Loading wines... &nbsp;</span>
                <font-awesome-icon
                    :icon="['fas', 'wine-glass']"
                    spin
                />
            </div>

            <div
                v-else
                class="flex flex-col"
            >
                <div
                    v-for="wine in wines"
                    :key="wine.id"
                    class="flex my-1 px-4 py-2 bg-white rounded-lg shadow-lg border border-transparent hover:shadow-md hover:border-grey cursor-pointer"
                >
                    <div class="w-1/4">
                        <img
                            :src="wine.thumbnailCover"
                            :alt="wine.name"
                            class="border border-transparent hover:border-grey-light rounded-lg"
                        >
                    </div>
                    <div class="w-3/4 pl-2">
                        <div class="flex flex-col">
                            <!--Wine Name-->
                            <a
                                :href="route('wine.show', wine.slug)"
                                class="text-lg text-grey-darker py-4 antialiased border-b border-grey-light"
                            >{{ wine.name }}</a>

                            <!--Winery Name-->
                            <a
                                :href="route('winery.show', wine.winery.slug)"
                                class="text-grey-darker antialiased py-4 border-b border-grey-light"
                            >Winery: {{ wine.winery.name }}</a>

                            <!--Wine Price-->
                            <a
                                :href="route('wines.index.query', wine.year)"
                                class="text-grey-darker antialiased py-4 border-b border-grey-light"
                            >Year: {{ wine.year }}</a>

                            <!--Wine Ranking-->
                            <a
                                :href="route('wines.index.query', wine.rank)"
                                class="text-grey-darker antialiased py-4 border-b border-grey-light"
                            >Ranking: {{ wine.rank }}</a>

                            <!--Wine Rating-->
                            <a
                                :href="route('wines.index.query', rating(wine))"
                                class="text-grey-darker antialiased py-4 border-b border-grey-light"
                            >Rating: {{ rating(wine) }}</a>

                            <!--Buttons-->
                            <div class="flex justify-center pt-4">
                                <!--Add to Wishlist-->
                                <span
                                    class="text-center text-xs bg-transparent hover:bg-blue text-blue hover:text-white font-bold py-2 px-4 border border-blue rounded-full"
                                >Add to Wishlist</span>

                                <!--Add to Cart-->
                                <button
                                    :class="[! wineIsInStock(wine) ? 'opacity-50 cursor-not-allowed bg-red text-white hover:bg-transparent hover:text-red' : 'bg-transparent hover:bg-blue text-blue hover:text-white' ]"
                                    :disabled="! wineIsInStock(wine)"
                                    class="ml-2 text-center text-xs font-bold py-2 px-4 border border-blue rounded-full"
                                    @click="addWineToCart(wine)"
                                >{{ wineIsInStock(wine) ? 'Add to Cart' : 'Sold Out!' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Errors-->
        <!--<div-->
            <!--v-if="errors"-->
            <!--class="mx-auto text-danger"-->
        <!--&gt;-->
            <!--<p v-for="error in errors">{{ error }}</p>-->
        <!--</div>-->

        <!--Wine List-->
        <!--<div-->
            <!--v-for="wine in wines"-->
            <!--:key="wine.id"-->
            <!--class="col-xs-12 col-sm-6 col-lg-4 col-xl-3 mb-4"-->
        <!--&gt;-->
            <!--<div class="card">-->
                <!--<img-->
                    <!--:src="wine.thumbnailCover"-->
                    <!--:alt="wine.name"-->
                    <!--class="card-img-top"-->
                <!--&gt;-->
                <!--<div class="card-body">-->
                    <!--<h5>-->
                        <!--<a-->
                            <!--:href="route('wine.show', wine.slug)"-->
                            <!--class="card-title"-->
                        <!--&gt;{{ wine.name }}</a>-->
                    <!--</h5>-->
                    <!--<p class="card-text text-truncate">{{ wine.description }}</p>-->
                <!--</div>-->
                <!--<ul class="list-group list-group-flush">-->
                    <!--<li class="list-group-item"><small>Price</small> {{ wine.price }}</li>-->
                    <!--<li class="list-group-item"><small>Region</small> {{ wine.region.name }}</li>-->
                    <!--<li class="list-group-item">-->
                        <!--<small>Country</small>-->
                        <!--<span-->
                            <!--:class="countryFlag(wine)"-->
                            <!--class="flag-icon"-->
                        <!--&gt;</span>-->
                        <!--{{ wine.winery.country_name }}-->
                    <!--</li>-->
                    <!--<li class="list-group-item"><small>Average Rating</small> {{ wine.rating }}</li>-->
                    <!--<li class="list-group-item"><small>Year</small> {{ wine.year }}</li>-->
                <!--</ul>-->
                <!--<div class="card-body">-->
                    <!--<div class="row">-->
                        <!--<div class="col text-center">-->
                            <!--<button-->
                                <!--class="btn btn-sm btn-outline-info p-1 m-1"-->
                            <!--&gt;Add to Wishlist</button>-->
                        <!--</div>-->
                        <!--<div class="col text-center">-->
                            <!--<button-->
                                <!--v-if="! wineIsInStock(wine)"-->
                                <!--class="btn btn-sm btn-danger p-1 m-1"-->
                                <!--disabled-->
                            <!--&gt;Sold Out!</button>-->
                            <!--<button-->
                                <!--v-else-->
                                <!--class="btn btn-sm btn-outline-success p-1 m-1"-->
                                <!--@click.prevent="addWineToCart(wine)"-->
                            <!--&gt;Add to Cart</button>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
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
            rating (wine) {
                return Math.round(wine.rating)
            },

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