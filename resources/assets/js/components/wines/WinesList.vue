<template>
    <div>
        <!--Loading-->
        <div
            v-if="loading"
            class="flex justify-center"
        >
            <span
                class="bg-white text-center text-lg shadow-lg rounded-full px-4 py-1 border text-red-darker hover:text-white hover:bg-red-darker text-xs font-semibold leading-loose"
            >
                Loading wines... &nbsp;
                <font-awesome-icon
                    :icon="['fas', 'wine-glass']"
                    size="lg"
                    spin></font-awesome-icon>
            </span>
        </div>

        <!--Not Loading-->
        <div
            v-else
            class="flex flex-col"
        >
            <div
                v-for="wine in wines"
                :key="wine.id"
                class="flex mx-2 mb-4 px-4 py-2 bg-white rounded-lg shadow-lg border border-transparent hover:shadow-md hover:border-grey cursor-pointer"
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
                        <span
                            class="text-grey-darker antialiased py-4 border-b border-grey-light"
                        >Year: {{ wine.price | currency }}</span>

                        <!--Wine Year-->
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