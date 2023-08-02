<template>
    <div class="row" id="trader_transfer_list">
        <div class="col-lg-12">
            <b-card header="Trader Transfers Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Trader Transfers" :rows="tableData" :columns="columndata" url="admin/api/trader_transfers_list">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "trader_transfers_list",
        id: "trader_transfer_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Trader', 'Amount', 'Bank'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'trader', name: 'trader', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'bank', name: 'bank', sortable: false},
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
