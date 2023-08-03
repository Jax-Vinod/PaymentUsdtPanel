const menu_items = [
    {
        name: 'Notice',
        icon: 'fa fa-desktop',
        child: [{
                name: 'Notices List',
                link: '/notice',
                icon: 'fa fa-angle-double-right'
            }, {
                name: 'New notice',
                link: '/notice/add',
                icon: 'fa fa-angle-double-right'
            }
        ]
    }, {
        name: 'USDT Order',
        link: '/usdt_order',
        icon: ' fa fa-address-book-o'
    },
];
export default menu_items;
