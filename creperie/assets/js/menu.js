import Vue from 'vue'

import App from '../components/App.vue'
import Menu from '../components/Menu.vue'
import vuetify from "./vuetify";

import router from './routerMenu'
new Vue({
    router,
    vuetify,
    render: h => h(App) }).$mount('#menu')