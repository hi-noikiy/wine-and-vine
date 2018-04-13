<template>
    <!--TODO Watch https://www.youtube.com/watch?v=7gX_ApBeSpQ on 25'00''-->
    <nav class="bg-red-darker">
        <div class="container mx-auto px-4">
            <div class="flex items-center py-4 sm:justify-between">

                <!--Left Section-->
                <div class="w-1/3 sm:hidden">
                    <!--Hamburger-->
                    <div class="cursor-pointer">
                        <font-awesome-icon
                            :icon="['fal', 'bars']"
                            class="text-white"
                            size="lg"
                        />
                    </div>
                </div>

                <!--Middle Section-->
                <div class="w-1/3 text-center text-2xl sm:w-auto">
                    <span class="text-base sm:text-2xl text-white">{{ config.app.name }}</span>
                </div>

                <!--Right Section-->
                <div class="w-1/3 sm:w-auto flex justify-end items-center">
                    <!--Shopping Cart-->
                    <div class="pr-3 md:hidden">
                        <!--Icon-->
                        <font-awesome-icon
                            :icon="['far', 'shopping-cart']"
                            :class="[cartIsEmpty ? 'opacity-50' : '']"
                            size="lg"
                            class="text-white"
                        ></font-awesome-icon>
                        <!--Quantity Badge-->
                        <span
                            v-show="! cartIsEmpty"
                            class="-mt-8 -ml-3 px-2 py-1 align-top text-xs w-4 h-4 bg-red hover:bg-red-dark border-2 border-solid border-white rounded-full cursor-pointer text-white"
                        >{{ cartCount }}</span>
                    </div>

                    <img
                        class="h-10 w-10 rounded-full"
                        src="https://avatars2.githubusercontent.com/u/16735002?s=460&v=4"
                        alt=""
                    >

                    <div class="text-white hidden md:block md:flex md:items-center">
                        <span class="pl-2 text-sm">Rafael Macedo</span>
                        <div class="pl-2 cursor-pointer">
                            <font-awesome-icon
                                :icon="['fas', 'caret-down']"
                                class="text-white opacity-50"
                            ></font-awesome-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Navbar",

        computed: {
            ...mapGetters({
                config: 'config'
            }),

            ...mapGetters('cart', {
                cartIsEmpty: 'empty',
                cartCount: 'count'
            }),

            auth() {
                return window.auth
            }
        },

        methods: {
            set_active(uri, css_class = 'active') {
                return window.location.pathname === `/${uri}`
                    ? css_class
                    : ''
            },

            logout() {
                this.$refs.logoutForm.submit()
            }
        }
    }
</script>

<style scoped>

</style>