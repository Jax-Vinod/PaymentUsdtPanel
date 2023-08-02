import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes.js'
import store from '../store/store'

Vue.use(VueRouter)

const router = new VueRouter({
    // mode: 'history',
    routes,
    linkActiveClass: "active",
    // hashbang: false,
})

router.beforeEach((to, from, next) => {
    store.commit("routeChange", "start")
    // scroll to top when changing pages
    if (document.scrollingElement) {
        document.scrollingElement.scrollTop = 0
    } else if (document.documentElement) {
        document.documentElement.scrollTop = 0
    }
    console.log(to.path);
    const publicPages = ['/login', '/register', '/forgotpassword','/reset_password_token', '/admin/login', '/admin/register', '/admin/forgotpassword','/admin/reset_password_token'];
    // const adminPublicPages = ['admin/login', 'admin/register', 'admin/forgotpassword','admin/reset_password_token','admin/login'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem('token');
    if (authRequired && !loggedIn) {
        if (to.path.includes('admin')) {
            return next('/admin/login');
        } else
        return next('/login');
    }
    if (loggedIn) {
        if (to.path === '/admin') {
            return next('/admin/dashboard');
        }
    }
    next()
})

//====change page title after route change

router.afterEach((to, from) => {
    if (to.meta.title) {
        document.title = to.meta.title + " - " + store.site_name
        // set pageTitle to null if it is set manually elsewhere
        store.commit('changePageTitle', to.meta.title)
        store.commit("routeChange", "end")
        if (window.innerWidth <= 992) {
            store.commit('left_menu', "close")
        } else {
            store.commit('left_menu', "open")
        }
    }
})

export default router
