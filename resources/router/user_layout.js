const layout = [
    {
        path: 'notice',
        component: resolve => require(['pages/user/notice/notice_list'], resolve),
        meta: {
            title: "Notices",
        }
    }, {
        path: 'notice/add',
        component: resolve => require(['pages/user/notice/add_notice'], resolve),
        meta: {
            title: "Add Notice",
        }
    }, {
        path: 'usdt_order',
        component: resolve => require(['pages/user/usdt/usdt_list'], resolve),
        meta: {
            title: "USDT Orders",
        }
    }, {
        path: 'usdt_order/view/:id',
        component: resolve => require(['pages/user/usdt/view_usdt'], resolve),
        meta: {
            title: "View USDT Order",
        }
    }
]

export default layout
