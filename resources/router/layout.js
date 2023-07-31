const layout = [{
    path: '/',
    name: 'dashboard',
    component: resolve => require(['pages/index'], resolve),
    meta: {
        title: "Dashboard",
    }
}, {
    path: '/trader_transfer',
    component: resolve => require(['pages/trader_transfer_list'], resolve),
    meta: {
        title: "Trader Transfer",
    }
}, {
    path: 'usdt_purchase',
    component: resolve => require(['pages/usdt_purchase_list'], resolve),
    meta: {
        title: "USDT Purchase",
    }
}, {
    path: 'payout',
    component: resolve => require(['pages/payout_list'], resolve),
    meta: {
        title: "Payout",
    }

}, {
    path: 'loses',
    component: resolve => require(['pages/loses'], resolve),
    meta: {
        title: "Loses",
    }
}, {
    path: 'india_payments',
    component: resolve => require(['pages/india_payments'], resolve),
    meta: {
        title: "India Payments",
    }
}, {
    path: 'traders',
    component: resolve => require(['pages/traders_list'], resolve),
    meta: {
        title: "Traders",
    }
}, {
    path: 'beneficiarys',
    component: resolve => require(['pages/beneficiarys'], resolve),
    meta: {
        title: "Beneficiarys",
    }
}, {
    path: 'running_balances',
    component: resolve => require(['pages/running_balances'], resolve),
    meta: {
        title: "Running Balances",
    }
}]

export default layout
