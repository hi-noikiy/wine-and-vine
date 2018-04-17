import Vuex from 'vuex'
import Vue from 'vue'
import auth from './modules/auth'
import cart from './modules/cart'
import wines from './modules/wines'
import users from './modules/users'
import config from '../config/index'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        cart,
        wines,
        users
    },
    // <=> data
    state: {
        auth: window.auth
    },

    // <=> computed properties
    getters: {
        auth (state) {
            return state.auth.user
        },

        isAuthenticated (state, getters) {
            return getters.auth !== null
        },

        config () {
            return config
        }
    },

    actions: {

    },

    // <=> single state change
    mutations: {

    }
});