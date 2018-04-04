import axios from "axios/index";

export default {
    namespaced: true,

    state: {
        wines: []
    },

    getters: {
        all (state) {
            return state.wines
        },

        count (state, getters) {
            return getters.all.length
        },

        wineIsInStock () {
            return (wine) => wine.quantity_in_stock > 0
        },

        availableWines(state, getters) {
            return getters.all.filter(wine => wine.quantity_in_stock > 0)
        }
    },

    actions: {
        fetchWines({commit}) {
            return axios.get('wines/index')
                .then(({data}) => commit('setWines', data))
                .catch(error => commit('setErrors', error))
        }
    },

    mutations: {
        setWines (state, wines) {
            state.wines = wines
        },

        incrementWineStock(state, wine) {
            const wineToUpdate = state.wines.find(wineToFind => wineToFind.id === wine.id);
            if (wineToUpdate) {
                wineToUpdate.quantity_in_stock++
            }
        },

        decrementWineStock(state, wine) {
            const wineToUpdate = state.wines.find(wineToFind => wineToFind.id === wine.id);
            if (wineToUpdate) {
                wineToUpdate.quantity_in_stock--
            }
        }
    }
}