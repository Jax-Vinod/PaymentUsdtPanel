const menu_items = [{
    name: 'Dashboard',
    link: '/admin/dashboard',
    icon: ' fa fa-home'
}, {
    name: 'Notice',
    link: '/admin/notice',
    icon: 'fa fa-desktop'
}, {
    name: 'Trader Transfer',
    link: '/admin/trader_transfer',
    icon: 'fa fa-desktop'
}, {
    name: 'USDT Purchase',
    link: '/admin/usdt_purchase',
    icon: ' fa fa-address-book-o'
},
{
    name: 'Payout',
    link: '/admin/payout',
    icon: ' fa fa-address-book-o'
},
{
    name: 'Loses',
    link: '/admin/loses',
    icon: ' fa fa-address-book-o'
},
{
    name: 'India Payments',
    link: '/admin/india_payments',
    icon: ' fa fa-address-book-o'
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
{
    name: 'Beneficiarys',
    link: '/admin/beneficiarys',
    icon: ' fa fa-users'
},
{
    name: 'Running Balances',
    link: '/admin/running_balances',
    icon: ' fa fa-users'
},
];
export default menu_items;
