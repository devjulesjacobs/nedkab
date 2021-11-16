import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from './views/Dashboard/Dashboard'
import Signin from './views/Auth/Signin'

Vue.use(VueRouter)

const routes = [
    {
        path: '/cms',
        name: 'Dashboard',
        component: Dashboard,
        meta: { requiresAdmin: true }
    },
    {
        path: '/cms/signin',
        name: 'CmsSignin',
        component: Signin
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
