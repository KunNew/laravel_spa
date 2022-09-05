import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import user from './custom/user';
import guest from './custom/guest';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            component: () => import('./../views/layouts/App.vue'),
            children: [
                { path: '/', redirect: { name: 'home' } },
                {
                    path: '/dashboard',
                    name: 'home',
                    component: () => import('./../views/Dashboard.vue')
                },

                ...user,
            ]
        },

        {
            path: '/',
            component: () => import('./../views/layouts/Guest.vue'),
            children: [
                ...guest,
            ]
        }

    ]
});

router.beforeEach((to, from, next) => {
    const guestRoute = ['login', 'register', 'forget', 'password.reset']
    if (store.state.auth.authenticated) {
        if (guestRoute.includes(to.name)) next({ name: 'home' })
        else next()
    } else {
        if (guestRoute.includes(to.name) || to.name == 'farm.monitoring') next()
        else next({ name: 'login' })
    }
})

export default router;
