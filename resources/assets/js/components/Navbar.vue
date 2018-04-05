<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">
        <div class="container">
            <a
                :href="route('welcome')"
                class="navbar-brand"
            >{{ config.app.name }}</a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            ><span class="navbar-toggler-icon"></span></button>

            <div
                id="navbarSupportedContent"
                class="collapse navbar-collapse"
            >
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a
                            :href="route('wines.index')"
                            :class="set_active('wines/index')"
                            class="nav-link"
                        >Browse</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul
                    v-if="! auth.user"
                    class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li>
                        <a
                            :href="route('login')"
                            :class="set_active('login')"
                            class="nav-link"
                        >Login</a>
                    </li>
                    <li>
                        <a
                            :href="route('register')"
                            :class="set_active('register')"
                            class="nav-link"
                        >Register</a>
                    </li>
                </ul>

                <ul
                    v-else
                    class="navbar-nav ml-auto"
                >
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            {{ auth.user.first_name }}
                            <span class="caret"></span>
                        </a>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdown"
                        >
                            <a
                                :href="route('user.profile.show', auth.user.username)"
                                :class="set_active(`user/@${auth.user.username}`)"
                                class="dropdown-item"
                            >My Profile</a>

                            <!--Dropdown divider-->
                            <div class="dropdown-divider"></div>

                            <!--TODO: Realise how to logout with axios-->
                            <a
                                :href="route('logout')"
                                class="dropdown-item"
                                @click.prevent="logout"
                            >Logout</a>

                            <form
                                ref="logoutForm"
                                :action="route('logout')"
                                method="POST"
                                style="display: none;"></form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters } from 'vuex'

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