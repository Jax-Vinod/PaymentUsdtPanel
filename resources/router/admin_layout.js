const layout = [{
    path: '/',
    name: 'dashboard',
    component: resolve => require(['pages/admin/index'], resolve),
    meta: {
        title: "Dashboard",
    }
}, {
    path: 'trader_transfer',
    component: resolve => require(['pages/admin/trader_transfer_list'], resolve),
    meta: {
        title: "Trader Transfer",
    }
}, {
    path: 'usdt_purchase',
    component: resolve => require(['pages/admin/usdt_purchase_list'], resolve),
    meta: {
        title: "USDT Purchase",
    }
}, {
    path: 'payout',
    component: resolve => require(['pages/admin/payout_list'], resolve),
    meta: {
        title: "Payout",
    }

}, {
    path: 'loses',
    component: resolve => require(['pages/admin/loses'], resolve),
    meta: {
        title: "Loses",
    }
}, {
    path: 'india_payments',
    component: resolve => require(['pages/admin/india_payments'], resolve),
    meta: {
        title: "India Payments",
    }
}, {
    path: 'traders',
    component: resolve => require(['pages/admin/traders_list'], resolve),
    meta: {
        title: "Traders",
    }
}, {
    path: 'beneficiarys',
    component: resolve => require(['pages/admin/beneficiarys'], resolve),
    meta: {
        title: "Beneficiarys",
    }
}, {
    path: 'running_balances',
    component: resolve => require(['pages/admin/running_balances'], resolve),
    meta: {
        title: "Running Balances",
    }
}]

export default layout
