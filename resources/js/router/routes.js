const routes = [
    // {
    //     path: '/',
    //     redirect: '/dashboard'
    // },
    
    {
        path: '/member/edit/:id',
        name: 'member.edit',
        component: require('../views/members/Edit.vue'),
        props: true
    },
    {
        path: '*',
        name: '404',
        component: require('../views/errors/Error404.vue')
    }
];

export default routes;