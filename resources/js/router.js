import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/app/Home/Home'
import Signin from './views/app/Auth/Signin'
import Cables from "./views/app/Cables/Cables";
import Emballage from "./views/app/Emballage/Emballage";
import Cpr from "./views/app/Cpr/Cpr";
import Account from './views/app/Account/Account'

import Dashboard from './views/cms/Dashboard/Dashboard.vue'
import CmsSignin from './views/cms/Auth/Signin.vue'

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
    },

    {
        path: '/cms',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/cms/signin',
        name: 'CmsSignin',
        component: CmsSignin
    },
]

const router = new VueRouter({
  mode: 'history',
  // base: process.env.BASE_URL,
  routes
})

export default router
