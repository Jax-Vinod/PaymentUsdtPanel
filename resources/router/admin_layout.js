const layout = [{
    path: 'dashboard',
    name: 'dashboard',
    component: resolve => require(['pages/admin/index'], resolve),
    meta: {
        title: "Dashboard",
    }
}, {
    path: 'notice',
    component: resolve => require(['pages/admin/trader_transfer_list'], resolve),
    meta: {
        title: "Trader Transfer",
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
    component: resolve => require(['pages/admin/trader/traders_list'], resolve),
    meta: {
        title: "Traders",
    }
}, {
    path: 'trader/add',
    component: resolve => require(['pages/admin/trader/add_trader'], resolve),
    meta: {
        title: "Add Trader",
    }
}, {
    path: 'trader/edit/:user_id',
    component: resolve => require(['pages/admin/trader/edit_trader'], resolve),
    meta: {
        title: "Edit Trader",
    }
}, {
    path: 'agents',
    component: resolve => require(['pages/admin/agent/agent_list'], resolve),
    meta: {
        title: "Agents",
    }
}, {
    path: 'agent/add',
    component: resolve => require(['pages/admin/agent/add_agent'], resolve),
    meta: {
        title: "Add Agent",
    }
}, {
    path: 'agent/edit/:user_id',
    component: resolve => require(['pages/admin/agent/edit_agent'], resolve),
    meta: {
        title: "Edit Agent",
    }
}, {
    path: 'admins',
    component: resolve => require(['pages/admin/admin/admin_list'], resolve),
    meta: {
        title: "Admins",
    }
}, {
    path: 'admin/add',
    component: resolve => require(['pages/admin/admin/add_admin'], resolve),
    meta: {
        title: "Add Admin",
    }
}, {
    path: 'admin/edit/:user_id',
    component: resolve => require(['pages/admin/admin/edit_admin'], resolve),
    meta: {
        title: "Edit Admin",
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
