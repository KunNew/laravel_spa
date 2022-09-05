export default [
    {
        path: '/user',
        name: 'user.index',
        component: () => import('./../../views/user/Index.vue')
    },
    {
        path: '/user/create',
        name: 'user.create',
        component: () => import('./../../views/user/Create.vue')
    },
    {
        path: '/user/:user/edit',
        name: 'user.edit',
        component: () => import('./../../views/user/Edit.vue')
    },
    {
        path: '/user/:user/show',
        name: 'user.show',
        component: () => import('./../../views/user/Show.vue')
    },
]
