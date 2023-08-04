<template>
    <div class="row" id="trader_withdrawal_list">
        <div class="col-lg-12">
            <b-card header="Trader Withdrawal Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Trader Withdrawal" :rows="tableData" :columns="columndata" url="admin/api/trader_withdrawals">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "trader_withdrawals_list",
        id: "trader_withdrawal_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Trader', 'Amount', 'Purpose'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'trader', name: 'trader', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'note', name: 'note', sortable: false},
                ],
                columnDefs: []
            }
        },
        methods: {
        },
        mounted() {
        },
    }
</script>
