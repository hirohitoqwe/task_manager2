import './bootstrap';

import {createApp} from 'vue';
import App from "./src/App.vue";
import Home from "./src/Home.vue";
import {createRouter, createWebHistory, Router, RouterHistory} from 'vue-router'
import Login from "./src/User/Login.vue";
import Registration from "./src/User/Registration.vue";

const routerHistory: RouterHistory = createWebHistory()

const router: Router = new createRouter({
    history: routerHistory,
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/user/login',
            name: 'login',
            component: Login
        },
        {
            path: '/user/registration',
            name: 'registration',
            component: Registration
        }
    ],
});

router.beforeEach((to, from, next) => {
    if (to.name !== 'login' && to.name !== 'registration' && localStorage.getItem('token') == null) {
        return next({
            name: 'login'
        });
    }

    if ((to.name === 'login' || to.name === 'registration') && localStorage.getItem('token') !== null) {
        return next({
                name: 'home'
            }
        );
    }

    next();

})

const app = createApp(App).use(router)
app.mount('#app')

