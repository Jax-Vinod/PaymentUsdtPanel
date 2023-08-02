<template>
    <div class="row" id="payouts_list">
        <div class="col-lg-12">
            <b-card header="Payouts Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Payouts" :rows="tableData" :columns="columndata" url="admin/api/payouts">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "payouts_list",
        id: "payouts_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Manager', 'Amount', 'Bank', 'Document'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'admin', name: 'admin', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'bank', name: 'bank', sortable: false},
                    {data: 'document', name: 'document', sortable: false},
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
