<template>
    <!--TODO Watch https://www.youtube.com/watch?v=7gX_ApBeSpQ on 25'00''-->
    <nav class="bg-red-darker">
        <div class="container mx-auto px-4">
            <div class="flex items-center py-4 sm:justify-between">

                <!--Left Section-->
                <wav-sidebar></wav-sidebar>

                <!--Middle Section-->
                <div class="w-1/3 sm:w-auto inline-flex text-center text-2xl items items-center">
                    <!--App Name-->
                    <a
                        :href="route('welcome', [], false)"
                        class="text-base sm:text-2xl text-white"
                    >{{ config.app.name }}</a>
                    <!--Browse All Wines-->
                    <a
                        :href="route('wines.index', [], false)"
                        class="hidden sm:block ml-6 text-base tracking-wide text-white"
                    >Browse</a>
                </div>

                <!--Right Section-->
                <!--Auth-->
                <div
                    v-if="user"
                    class="w-1/3 sm:w-auto flex justify-end items-center">
                    <!--Shopping Cart-->
                    <div
                        class="pr-3 lg:hidden"
                        @click="$modal.show('shopping-cart')"
                    >
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
                            class="-mt-3 -ml-3 px-2 py-1 align-top text-xs w-4 h-4 bg-red hover:bg-red-dark border-2 border-solid border-white rounded-full cursor-pointer text-white"
                        >{{ cartCount }}</span>
                    </div>

                    <div class="text-white hidden md:block md:flex md:items-center">
                        <!--User Full Name-->
                        <span class="pr-2 text-sm tracking-wide">{{ fullname }}</span>
                    </div>

                    <!--User Image-->
                    <wav-dropdown>
                        <div
                            slot="heading"
                            class="rounded-full bg-blue-darkest w-10 h-10 flex items-center justify-center cursor-pointer relative z-10"
                        >
                            <img
                                :alt="user.first_name"
                                class="h-10 w-10 rounded-full"
                                src="https://avatars2.githubusercontent.com/u/16735002?s=460&v=4"
                            >
                        </div>

                        <template slot="links">
                            <li class="text-sm pb-3 text-black font-semibold">
                                <a :href="route('user.profile.show', user.username, false)">My Profile</a>
                            </li>
                        </template>
                    </wav-dropdown>
                </div>

                <!--Guest-->
                <div
                    v-else
                    class="w-1/3 sm:w-auto flex justify-end items-center"
                >
                    <a
                        :href="route('register', [], false)"
                        class="p-1 text-sm bg-transparent hover:bg-white text-white mr-2"
                    >
                        <font-awesome-icon
                            :icon="['fal', 'user-plus']"
                            size="lg"
                        ></font-awesome-icon>
                    </a>
                    <a
                        :href="route('login', [], false)"
                        class="p-1 text-sm bg-transparent hover:bg-white text-white"
                    >
                        <font-awesome-icon
                            :icon="['fal', 'sign-in']"
                            size="lg"
                        ></font-awesome-icon>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import axios from 'axios'
    import {mapGetters} from 'vuex'

    export default {
        name: "Navbar",

        computed: {
            ...mapGetters({
                config: 'config'
            }),

            ...mapGetters('auth', {
                user: 'user',
                fullname: 'fullname'
            }),

            ...mapGetters('cart', {
                cartIsEmpty: 'empty',
                cartCount: 'count'
            })
        },

        methods: {
            set_active(uri, css_class = 'active') {
                return window.location.pathname === `/${uri}`
                    ? css_class
                    : ''
            },

            logout() {
                axios.post(route('logout', [], false), auth.user.username)
                    .then(() => location.reload())
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style scoped>

</style>