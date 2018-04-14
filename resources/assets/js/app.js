/** Absolute path imports */
import Vue from 'vue'
import fontawesome from "@fortawesome/fontawesome"
import solid from "@fortawesome/fontawesome-pro-solid"
import light from "@fortawesome/fontawesome-pro-light"
import regular from "@fortawesome/fontawesome-pro-regular"
import brands from '@fortawesome/fontawesome-free-brands'
import {FontAwesomeIcon, FontAwesomeLayers} from '@fortawesome/vue-fontawesome'
import Notifications from 'vue-notification'
import velocity from 'velocity-animate'
import store from './store/index'
import { currency } from "./filters/Currency"
import route from "../../../vendor/tightenco/ziggy/src/js/route";

/** Global Font Awesome Icon Component */
Vue.component('icon', {
    props: {
        name: {
            required: true,
            type: String
        },
        weight: {
            required: false,
            type: String,
            default: "light"
        }
    },
    template: `<svg><use :xlink:href="'storage/icons/sprites/fa/' + weight + '.svg#' + name"></use></svg>`
});

require('./bootstrap');

fontawesome.library.add(solid, light, regular, brands);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('font-awesome-layers', FontAwesomeLayers);
// Vue.component('users-list', require('./components/UsersList.vue'));
Vue.component('wines-list', require('./components/wines/WinesList.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('wav-shopping-cart', require('./components/cart/ShoppingCart.vue'));

Vue.filter('currency', currency);

Vue.use(Notifications, { velocity });

Vue.mixin({
    methods: {
        route
    }
});

const app = new Vue({
    el: '#app',
    store
});

window.notify = (title, text, type = 'success') => {
    app.$notify({
        group: 'cart',
        title,
        text,
        type
    })
};

// Event Bus
window.bus = new Vue();