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
                <div class="w-1/3 sm:w-auto inline-flex text-center text-2xl items items-center">
                    <!--App Name-->
                    <a
                        :href="route('welcome')"
                        class="text-base sm:text-2xl text-white"
                    >{{ config.app.name }}</a>
                    <!--Browse All Wines-->
                    <a
                        :href="route('wines.index')"
                        class="hidden sm:block ml-6 text-base tracking-wide text-white"
                    >Browse</a>
                </div>

                <!--Right Section-->
                <!--Auth-->
                <div
                    v-if="auth.user"
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

                    <!--User Image-->
                    <img
                        :alt="auth.user.first_name"
                        class="h-10 w-10 rounded-full"
                        src="https://avatars2.githubusercontent.com/u/16735002?s=460&v=4"
                        @click="showingUserSettings = true"
                    >

                    <div class="text-white hidden md:block md:flex md:items-center">
                        <!--User Full Name-->
                        <span class="pl-2 text-sm tracking-wide">{{ userFullName }}</span>
                        <!--Chevron-->
                        <div class="ml-2 cursor-pointer">
                            <dropdown
                                :visible="showingUserSettings"
                                :position="['left', 'bottom', 'right', 'top']"
                                @clickout="showingUserSettings = false"
                            >
                                <!--Dropdown Trigger-->
                                <span @click="showingUserSettings = true">
                                    <font-awesome-icon
                                        :icon="['fas', 'caret-down']"
                                        class="text-white opacity-50"
                                    ></font-awesome-icon>
                                </span>
                                <div
                                    slot="dropdown"
                                    class="mt-2 flex flex-col items-center py-2 px-3 bg-grey rounded-lg"
                                >
                                    <a
                                        :href="route('user.profile.show', auth.user.username)"
                                        class="text-grey-darkest"
                                    >My Profile</a>

                                    <!--Horizontal Rule-->
                                    <span class="my-2 border-b border-grey-darkest w-full"></span>

                                    <button
                                        class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-4 rounded"
                                        @click="logout"
                                    >Logout</button>
                                </div>
                            </dropdown>

                        </div>
                    </div>
                </div>

                <!--Guest-->
                <div
                    v-else
                    class="w-1/3 sm:w-auto flex justify-end items-center"
                >
                    <a
                        :href="route('register')"
                        class="p-1 text-sm bg-transparent hover:bg-white text-white mr-2"
                    >
                        <font-awesome-icon
                            :icon="['fal', 'user-plus']"
                            size="lg"
                        ></font-awesome-icon>
                    </a>
                    <a
                        :href="route('login')"
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

        data () {
            return {
                showingUserSettings: false
            }
        },

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
            },

            userFullName () {
                return `${this.auth.user.first_name} ${this.auth.user.last_name}`
            }
        },

        methods: {
            set_active(uri, css_class = 'active') {
                return window.location.pathname === `/${uri}`
                    ? css_class
                    : ''
            },

            logout() {
                axios.post(route('logout'), auth.user.username)
                    .then(() => location.reload())
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style scoped>

</style>