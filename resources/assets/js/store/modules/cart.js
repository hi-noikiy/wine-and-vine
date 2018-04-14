import axios from "axios/index";

export default {
    namespaced: true,

    state: {
        cart: []
    },

    getters: {
        all (state) {
            return state.cart
        },

        empty (state, getters) {
            return getters.all.length === 0
        },

        count (state, getters) {
            return getters.all
                .map(product => product.quantity)
                .reduce((total, quantity) => total + quantity, 0)
        },

        total (state, getters) {
            return getters.all.reduce((total, product) => total + (product.price * product.quantity), 0)
        }
    },

    actions: {
        addProductToCart ({getters, commit, rootState, rootGetters}, product) {
            if (rootGetters.isAuthenticated && rootGetters['wines/wineIsInStock'](product)) {
                const wineInCart = getters.all.find(needle => needle.id === product.id);
                if (!wineInCart) {
                    commit('addProductToCart', product)
                } else {
                    commit('incrementQuantity', product)
                }
                commit('wines/decrementWineStock', product, { root: true })
            }
            else {
                window.notify('Whoops!', 'You have to be logged in order to buy.', 'error')
            }
        },

        removeProductFromCart ({state, commit}, product) {
            const cartProduct = state.cart.find(needle => needle.id === product.id);
            if (cartProduct) {
                if (cartProduct.quantity > 1) {
                    commit('decrementQuantity', cartProduct)
                } else {
                    commit('deleteProductFromCart', cartProduct)
                }
                commit('wines/incrementWineStock', product, { root: true })
            }
        },

        checkout({commit}) {
            const endpoint = Math.random() > 0.5
                ? '/'
                : '/not/existing/endpoint';

            axios.get(endpoint)
                .then(() => {
                    commit('emptyCart');
                    window.notify('Done!', 'Your purchase was successful!', 'success')
                })
                .catch(() => {
                    window.notify('Whoops!', 'Something went wrong! Try again later.', 'error')
                });
        }
     },

    mutations: {
        addProductToCart (state, product) {
            state.cart.push({
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: 1
            })
        },

        deleteProductFromCart (state, product) {
            state.cart.splice(state.cart.indexOf(product), 1)
        },

        incrementQuantity (state, product) {
            const productToIncrement = state.cart.find(needle => needle.id === product.id);
            if (productToIncrement) {
                productToIncrement.quantity++
            }
        },

        decrementQuantity (state, product) {
            const productToDecrement = state.cart.find(needle => needle.id === product.id)
            if (productToDecrement) {
                productToDecrement.quantity--
            }
        },

        emptyCart(state) {
            state.cart = []
        }
    }
}