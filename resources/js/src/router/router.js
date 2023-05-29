import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history : createWebHistory('/'),
    routes: [
        {
            path :'/',
            component: () => import('../Layout/index.vue'),
            redirect: '/dashboard',
            children : [
                {
                    path:'/dashboard', name:'home', component: () => import('../views/dashboard/Dashboard.vue')
                },
                {
                    path:'/manage-user',name:'user', component: () => import('../views/user/User.vue')
                },
                {
                    path:'/projects',name:'projects', component: () => import('../views/projects/index.vue')
                },
                {
                    path:'/todo',name:'todo', component: () => import('../views/kanban/index.vue')
                },
            ],
            meta : {
                requiresAuth:true
            }
        },
        {
            path :'/login',
            name : 'login',
            component: () => import('../views/auth/Login.vue'),
            meta : {
                requiresAuth : false
            }
        },
        {
            path: '/register',
            name: 'register',
            component : import('../views/auth/Register.vue'),
            meta: {
                requiresAuth:false
            }
        }
    ]
});

router.beforeEach((to, from) => {
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return {name:'login'}
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token')){
        return {name:'home'}
    }
})

export default router;