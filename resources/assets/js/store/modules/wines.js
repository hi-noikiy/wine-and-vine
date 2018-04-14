import axios from "axios/index";
import route from "../../../../../vendor/tightenco/ziggy/src/js/route";

export default {
    namespaced: true,

    state: {
        wines: [],
        errors: []
    },

    getters: {
        errors (state) {
            return state.errors
        },

        all (state) {
            return state.wines
        },

        count (state, getters) {
            return getters.all.length
        },

        wineIsInStock (state, getters) {
            return (wine) => {
                const available = getters.availableWines.find(needle => needle.id === wine.id);
                return !!available
            };
        },

        availableWines(state, getters) {
            return getters.all.filter(wine => wine.quantity_in_stock > 0)
        }
    },

    actions: {
        fetchWines({commit}) {
            return axios.get(route('wines.index'))
                .then(({data}) => commit('setWines', data))
                .catch(({message}) => commit('setErrors', message))
        }
    },

    mutations: {
        setWines (state, wines) {
            state.wines = wines
        },

        setErrors (state, message) {
            state.errors.push(message)
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