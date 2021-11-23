import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from './views/Dashboard/Dashboard'
import Signin from './views/Auth/Signin'
import Posts from "./views/Posts/Posts"
import Emballage from "./views/Emballage/Emballage"
import Team from "./views/Team/Team"

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
        path: '/cms/team',
        name: 'Team',
        component: Team,
        meta: { requiresAdmin: true }
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
