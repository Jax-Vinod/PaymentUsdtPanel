const layout = [{
    path: 'dashboard',
    name: 'dashboard',
    component: resolve => require(['pages/admin/index'], resolve),
    meta: {
        title: "Dashboard",
    }
}, {
    path: 'notice',
    component: resolve => require(['pages/admin/notice_list'], resolve),
    meta: {
        title: "Notice",
    }
}, {
    path: 'transfers',
    component: resolve => require(['pages/admin/transfer/transfer_list'], resolve),
    meta: {
        title: "Transfer",
    }
}, {
    path: 'transfer/new',
    component: resolve => require(['pages/admin/transfer/new_transfer'], resolve),
    meta: {
        title: "Transfer",
    }
}, {
    path: 'usdt_purchase',
    component: resolve => require(['pages/admin/usdt/usdt_purchase_list'], resolve),
    meta: {
        title: "USDT Purchase List",
    }
}, {
    path: 'usdt_purchase/new',
    component: resolve => require(['pages/admin/usdt/new_usdt_purchase'], resolve),
    meta: {
        title: "New USDT Purchase",
    }
}, {
    path: 'usdt_purchase/view/:id',
    component: resolve => require(['pages/admin/usdt/view_usdt_purchase'], resolve),
    meta: {
        title: "View USDT Purchase",
    }
}, {
    path: 'payout',
    component: resolve => require(['pages/admin/payout_list'], resolve),
    meta: {
        title: "Payout",
    }

}, {
    path: 'chargeback',
    component: resolve => require(['pages/admin/loses/chargeback'], resolve),
    meta: {
        title: "Chargeback",
    }
}, {
    path: 'bank_withdrawal',
    component: resolve => require(['pages/admin/loses/bank_withdrawal'], resolve),
    meta: {
        title: "Bank Withdrawal",
    }
}, {
    path: 'trader_withdrawal',
    component: resolve => require(['pages/admin/loses/trader_withdrawal'], resolve),
    meta: {
        title: "Trader Withdrawal",
    }
}, {
    path: 'trader_topup',
    component: resolve => require(['pages/admin/loses/trader_topup'], resolve),
    meta: {
        title: "Trader Topup",
    }
}, {
    path: 'blocked_traders',
    component: resolve => require(['pages/admin/loses/blocked_traders'], resolve),
    meta: {
        title: "Blocked Trader",
    }
}, {
    path: 'blocked_banks',
    component: resolve => require(['pages/admin/loses/blocked_banks'], resolve),
    meta: {
        title: "Blocked Bank",
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
    path: 'banks',
    component: resolve => require(['pages/admin/bank/bank_list'], resolve),
    meta: {
        title: "Banks",
    }
}, {
    path: 'bank/add',
    component: resolve => require(['pages/admin/bank/add_bank'], resolve),
    meta: {
        title: "Add Bank",
    }
}, {
    path: 'bank/edit/:bank_id',
    component: resolve => require(['pages/admin/bank/edit_bank'], resolve),
    meta: {
        title: "Edit Bank",
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
