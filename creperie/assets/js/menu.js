import Vue from 'vue'

import Menu from '../components/Menu.vue'
import vuetify from "./vuetify";

import routerMenu from './routerMenu'
new Vue({
    routerMenu,
    vuetify,
    render: h => h(Menu) }).$mount('#menu')