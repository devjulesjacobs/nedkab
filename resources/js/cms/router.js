import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from './views/Dashboard/Dashboard'
import Signin from './views/Auth/Signin'
import Posts from "./views/Posts/Posts"
import Emballage from "./views/Emballage/Emballage"
import Users from "./views/Users/Users"
import Cables from "./views/Cables/Cables";

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
        name: 'Signin',
        component: Signin
    },
    {
        path: '/cms/posts',
        name: 'Posts',
        component: Posts,
        meta: { requiresAdmin: true }
    },
    {
        path: '/cms/emballage',
        name: 'Emballage',
        component: Emballage,
        meta: { requiresAdmin: true }
    },
    {
        path: '/cms/cables',
        name: 'Cables',
        component: Cables,
        meta: { requiresAdmin: true }
    },
    {
        path: '/cms/users',
        name: 'Users',
        component: Users,
        meta: { requiresAdmin: true }
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
