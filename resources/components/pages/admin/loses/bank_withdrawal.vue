<template>
    <div class="row" id="bank_withdrawal_list">
        <div class="col-lg-12">
            <b-card header="Bank Withdrawal Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Bank Withdrawal" :rows="tableData" :columns="columndata" url="admin/api/bank_withdrawals">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "bank_withdrawals_list",
        id: "bank_withdrawal_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Bank', 'Amount', 'Purpose'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'bank', name: 'bank', sortable: false},
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
