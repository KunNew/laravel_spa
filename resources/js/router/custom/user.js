export default [
    {
        path: '/setting',
        name: 'setting',
        component: () => import('./../../views/Setting.vue')
    },
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
    {
        path: '/permission',
        name: 'permission',
        component: () => import('./../../views/permission/Index.vue')
    },
    {
        path: '/permission/create',
        name: 'permission.create',
        component: () => import('./../../views/permission/Create.vue')
    },
    {
        path: '/permission/:permission/edit',
        name: 'permission.edit',
        component: () => import('./../../views/permission/Edit.vue')
    },
    {
        path: '/permission/:permission/show',
        name: 'permission.show',
        component: () => import('./../../views/permission/Show.vue')
    },
    {
        path: '/role',
        name: 'role',
        component: () => import('./../../views/role/Index.vue')
    },
    {
        path: '/role/create',
        name: 'role.create',
        component: () => import('./../../views/role/Create.vue')
    },
    {
        path: '/role/:role/edit',
        name: 'role.edit',
        component: () => import('./../../views/role/Edit.vue')
    },
    {
        path: '/role/:role/show',
        name: 'role.show',
        component: () => import('./../../views/role/Show.vue')
    },
]
