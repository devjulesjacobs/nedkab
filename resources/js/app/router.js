import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/Home/Home'
import Signin from './views/Auth/Signin'
import Cables from "./views/Cables/Cables";
import Emballage from "./views/Emballage/Emballage";
import Cpr from "./views/Cpr/Cpr";
import Account from './views/Account/Account'

Vue.use(VueRouter)

const routes = [
    {
        path: '/app/signin',
        name: 'Signin',
        component: Signin
    },
    {
        path: '/app',
        name: 'Home',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/app/cables',
        name: 'Cables',
        component: Cables,
        meta: { requiresAuth: true }
    },
    {
        path: '/app/emballage',
        name: 'Emballage',
        component: Emballage,
        meta: { requiresAuth: true }
    },
    {
        path: '/app/cpr',
        name: 'Cpr',
        component: Cpr,
        meta: { requiresAuth: true }
    },
    {
        path: '/app/account',
        name: 'Account',
        component: Account,
        meta: { requiresAuth: true }
    }
]

const router = new VueRouter({
  mode: 'history',
  // base: process.env.BASE_URL,
  routes
})

export default router
