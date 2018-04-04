import Vuex from 'vuex'
import Vue from 'vue'
import axios from 'axios'
import cart from './modules/cart'
import wines from './modules/wines'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        cart,
        wines
    },
    // <=> data
    state: {
        users: []
    },

    // <=> computed properties
    getters: {
        users(state) {
            return state.users
        },

        usersCount(state) {
            return state.users.length
        },
    },

    // <=>
    actions: {
        fetchUsers({commit}) {
            return axios.get('users/index')
                .then(({data}) => commit('setUsers', data))
                .catch(error => commit('setErrors', error))
        },
    },
    // <=> single state change
    mutations: {
        /**
         * @param state Vuex state
         * @param users Payload
         */
        setUsers(state, users) {
            state.users = users
        },
    }
});