import axios from "axios/index";

export default {
    namespaced: true,

    state: {
        user: window.auth.user
    },

    // <=> computed properties
    getters: {
        user(state) {
            return state.user
        },

        fullname (state, getters) {
            return `${state.user.first_name} ${state.user.last_name}`
        }
    },

    // <=>
    actions: {},
    // <=> single state change
    mutations: {}
}