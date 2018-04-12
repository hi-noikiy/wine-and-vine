import Vuex from 'vuex'
import Vue from 'vue'
import cart from './modules/cart'
import wines from './modules/wines'
import users from './modules/users'
import config from '../config/index'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        cart,
        wines,
        users
    },
    // <=> data
    state: {
        auth: null
    },

    // <=> computed properties
    getters: {
        auth (state) {
            return state.auth
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