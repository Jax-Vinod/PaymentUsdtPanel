const menu_items = [
//     {
//     name: 'Dashboard',
//     link: '/admin/dashboard',
//     icon: ' fa fa-home'
// },
{
    name: 'Notice',
    link: '/admin/notice',
    icon: 'fa fa-files-o'
}, {
    name: 'Transfer',
    icon: 'fa fa-exchange',
    child: [{
            name: 'Transfers List',
            link: '/admin/transfers',
            icon: 'fa fa-angle-double-right'
        }, {
            name: 'New Transfer',
            link: '/admin/transfer/new',
            icon: 'fa fa-angle-double-right'
        }
    ]
},
{
    name: 'USDT Purchase',
    link: '/admin/usdt_purchase',
    icon: ' fa fa-btc',
},
// {
//     name: 'Payout',
//     link: '/admin/payout',
//     icon: ' fa fa-money'
// },
// {
//     name: 'India Payments',
//     link: '/admin/india_payments',
//     icon: ' fa fa-inr'
// },
{
    name: 'Loses',
    icon: ' fa fa-cubes',
    child: [{
        name: 'Chargebacks',
        link: '/admin/chargeback',
        icon: 'fa fa-angle-double-right'
    }, {
        name: 'Trader Topup',
        link: '/admin/trader_topup',
        icon: 'fa fa-angle-double-right'
    }, {
        name: 'Trader Withdrawal',
        link: '/admin/trader_withdrawal',
        icon: 'fa fa-angle-double-right'
    }, {
        name: 'Bank Withdrawal',
        link: '/admin/bank_withdrawal',
        icon: 'fa fa-angle-double-right'
    }, {
        name: 'Blocked Traders',
        link: '/admin/blocked_traders',
        icon: 'fa fa-angle-double-right'
    }, {
        name: 'Blocked Banks',
        link: '/admin/blocked_banks',
        icon: 'fa fa-angle-double-right'
    }]
},
{
    name: 'Banks',
    icon: ' fa fa-bank',
    child: [{
            name: 'Banks List',
            link: '/admin/banks',
            icon: 'fa fa-angle-double-right'
        }, {
            name: 'Add Bank',
            link: '/admin/bank/add',
            icon: 'fa fa-angle-double-right'
        }
    ]
},
{
    name: 'Traders',
    icon: ' fa fa-users',
    child: [{
            name: 'Traders List',
            link: '/admin/traders',
            icon: 'fa fa-angle-double-right'
        }, {
            name: 'Add Trader',
            link: '/admin/trader/add',
            icon: 'fa fa-angle-double-right'
        }
    ]
},
{
    name: 'Agents',
    icon: ' fa fa-users',
    child: [{
            name: 'Agents List',
            link: '/admin/agents',
            icon: 'fa fa-angle-double-right'
        }, {
            name: 'Add Agent',
            link: '/admin/agent/add',
            icon: 'fa fa-angle-double-right'
        }
    ]
},
{
    name: 'Admins',
    icon: ' fa fa-users',
    child: [{
            name: 'Admins List',
            link: '/admin/admins',
            icon: 'fa fa-angle-double-right'
        }, {
            name: 'Add Admin',
            link: '/admin/admin/add',
            icon: 'fa fa-angle-double-right'
        }
    ]
},
// {
//     name: 'Beneficiarys',
//     link: '/admin/beneficiarys',
//     icon: ' fa fa-users'
// },
// {
//     name: 'Running Balances',
//     link: '/admin/running_balances',
//     icon: ' fa fa-users'
// },
];
export default menu_items;
