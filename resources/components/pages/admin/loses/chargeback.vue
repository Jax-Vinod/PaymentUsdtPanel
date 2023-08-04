<template>
    <div class="row" id="chargeback_list">
        <div class="col-lg-12">
            <b-card header="Chargeback Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Chargeback" :rows="tableData" :columns="columndata" url="admin/api/chargebacks">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "chargebacks_list",
        id: "chargeback_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Trader', 'Amount'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'trader', name: 'trader', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
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
