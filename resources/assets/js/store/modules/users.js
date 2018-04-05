import axios from "axios/index";

export default {
    namespaced: true,

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
        setUsers(state, users) {
            state.users = users
        },
    }
}