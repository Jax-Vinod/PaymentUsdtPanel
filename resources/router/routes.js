import admin_layout_routes from './admin_layout'
import user_layout_routes from './user_layout'

const routes = [
    {
        path: '/',
        component: resolve => require(['src/layout'], resolve),
        children: user_layout_routes
    }, {
        path: '/admin',
        component: resolve => require(['src/layout'], resolve),
        children: admin_layout_routes
    }, {
        path: '/admin/login',
        name: 'login',
        component: resolve => require(['pages/admin/login'], resolve),
        meta: {
            title: "Login",
        }
    }, {
        path: '/login',
        name: 'login',
        component: resolve => require(['pages/login'], resolve),
        meta: {
            title: "Login",
        }
    }, {
        path: '/register',
        name: 'register',
        component: resolve => require(['pages/register'], resolve),
        meta: {
            title: "register",
        }
    }, {
        path: '/forgotpassword',
        name: 'forgotpassword',
        component: resolve => require(['pages/forgotpassword'], resolve),
        meta: {
            title: "Forgot Password",
        }
    }, {
        path: '/reset_password/:token',
        name: 'reset_password_token',
        component: resolve => require(['pages/reset_password'], resolve),
        meta: {
            title: "Reset Password",
        }
    }, {
        path: '/lockscreen',
        component: resolve => require(['pages/lockscreen'], resolve),
        meta: {
            title: "Lockscreen",
        }
    }, {
        path: '/500',
        component: resolve => require(['pages/500'], resolve),
        meta: {
            title: "500",
        }
    },
    {
        path: '*',
        component: resolve => require(['pages/404'], resolve),
        meta: {
            title: "404",
        }
    }
]
export default routes
