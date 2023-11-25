import {createRouter, createWebHistory, Router, RouterHistory} from "vue-router";
import Home from "./src/components/TaskManager/Home.vue";
import Login from "./src/components/Auth/Login.vue";
import Registration from "./src/components/Auth/Registration.vue";

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
export default router;
