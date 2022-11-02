import {createWebHistory, createRouter} from "vue-router";
import Home from '../components/ExampleComponent.vue'
import test from '../components/test.vue'

export const routes = [
    {
        name: 'home',
        path: '/vue',
        component: Home
    },

    {
        name: 'test',
        path: '/home',
        component: test
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
