<template>
    <!--TODO Watch https://www.youtube.com/watch?v=7gX_ApBeSpQ on 25'00''-->
    <nav class="bg-red-darker">
        <div class="container mx-auto px-4">
            <div class="flex items-center py-4 sm:justify-between">
                <!--Left Section-->
                <div class="w-1/4 sm:hidden">
                    <!--Hamburger-->
                    <button>
                        <font-awesome-icon
                            :icon="['fal', 'bars']"
                            class="fa-2x text-white"
                        />
                    </button>
                </div>
                <!--Middle Section-->
                <div class="w-1/2 text-center text-2xl sm:w-auto">
                    <span class="text-white">{{ config.app.name }}</span>
                </div>
                <!--Right Section-->
                <div class="w-1/4 sm:w-auto sm:flex text-right">
                    <img
                        class="h-10 w-10 rounded-full"
                        src="https://avatars2.githubusercontent.com/u/16735002?s=460&v=4"
                        alt=""
                    >
                    <div class="text-white hidden sm:block sm:flex sm:items-center">
                        <span class="pl-2">Rafael Macedo</span>
                        <button class="pl-2">
                            <font-awesome-icon
                                :icon="['fas', 'caret-down']"
                                class="text-white opacity-50"
                            ></font-awesome-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters } from 'vuex'
    import config from '../config/index'

    export default {
        name: "Navbar",

        computed: {
            ...mapGetters({
                config: 'config'
            }),

            auth () {
                return window.auth
            }
        },

        methods: {
            set_active(uri, css_class = 'active') {
                return window.location.pathname === `/${uri}`
                    ? css_class
                    : ''
            },

            logout () {
                this.$refs.logoutForm.submit()
            }
        }
    }
</script>

<style scoped>

</style>