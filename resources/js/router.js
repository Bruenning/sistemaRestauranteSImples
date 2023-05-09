import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('./Pages/Home.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('./Pages/NotFound.vue'),
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router