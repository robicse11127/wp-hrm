import Vue from 'vue'
import Vuex from 'vuex'
import Router from 'vue-router'
import VueRouter from 'vue-router'
import store from '../store/index'
import App from './App.vue'
import Settings from './components/pages/Settings.vue'

Vue.use( Vuex )
Vue.use( Router )

const routes = [
    {
        path: '/', components: { default: GeneralTab, tab: TabNavigation },
    },
]

const router = new VueRouter({
    routes,
})

new Vue({
    el: '#biddaloy-admin-app',
    store,
    router,
    render: h => h( App )
})