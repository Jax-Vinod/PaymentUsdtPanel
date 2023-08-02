<template>
    <div class="row" id="usdt_purchases_list">
        <div class="col-lg-12">
            <b-card header="USDT Purchase Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="USDT Purchase" :rows="tableData" :columns="columndata" url="admin/api/usdt_purchases">
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
                tableData: ['Date', 'Manager', 'Amount', 'Source Bank', 'Dest Bank', 'Document', 'Status', 'Action'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'admin', name: 'admin', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'source_bank', name: 'source_bank', sortable: false},
                    {data: 'dest_bank_detail', name: 'dest_bank_detail', sortable: false},
                    {data: 'document', name: 'document', sortable: false},
                    {data: 'status', name: 'status', sortable: false},
                    {data: 'action', name: 'action', sortable: false},
                ]
            }
        },
        methods: {
        },
        mounted() {
        },
    }
</script>

<style type="text/css">

</style>
