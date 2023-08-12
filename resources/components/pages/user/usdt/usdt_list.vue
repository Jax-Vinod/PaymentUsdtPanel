<template>
    <div class="row" id="usdt_purchases_list">
        <div class="col-lg-12">
            <b-card header="USDT Order Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="USDT Order" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="api/usdt_orders">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "usdt_purchases_list",
        id: "usdt_purchases_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Order No', 'Manager', 'Amount', 'Source Bank', 'Dest Bank', 'Document', 'Status', 'Action'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'order_no', name: 'order_no', sortable: false},
                    {data: 'admin', name: 'admin', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'source_bank', name: 'source_bank', sortable: false},
                    {data: 'dest_bank_detail', name: 'dest_bank_detail', sortable: false},
                    {data: 'document', name: 'document', sortable: false},
                    {data: 'status', name: 'status', sortable: false},
                    {data: 'action', name: 'action', sortable: false},
                ],
                columnDefs:[{
                    "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/usdt_order/view/" + row.id + "'><i class='fa fa-eye'> </i></a> ";
                        },
                        "targets": 8
                    }
                ],
            }
        },
        methods: {
        },
        mounted() {
        },
    }
</script>
