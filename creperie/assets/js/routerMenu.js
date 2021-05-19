import Vue from 'vue'
import Router from 'vue-router'
import Menu from '../components/Menu.vue'
import crepe from '../components/crepe.vue'

Vue.use(Router)

export default new Router({
    //mode:'history',
    routes: [
        {
            path: '/',
            name: 'menu',
            component: Menu
        },{
            path: '/:name',
            name:'crepe',
            component: crepe
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
})
